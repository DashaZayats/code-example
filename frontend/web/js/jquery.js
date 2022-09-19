/**
@author Cameron Manavian
jQuery Style Switcher

The MIT License (MIT)

Copyright (c) 2014 Cameron Manavian

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
**/

(function ($) {
	var jStyleSwitcher,
		_defaultOptions = {
			hasPreview: true,
			defaultThemeId: 'jssDefault',
			fullPath: 'assets/css/',
			cookie: {
				expires: 30,
				isManagingLoad: true
			}
		},
		// private
		_cookieKey = 'jss_selected',
		_docCookies = {};

	/*\
	|*|
	|*|  :: cookies.js ::
	|*|
	|*|  A complete cookies reader/writer framework with full unicode support.
	|*|
	|*|  revision #1
	|*|
	|*|  https://developer.mozilla.org/en-US/docs/Web/API/document.cookie
	|*|
	|*|  This framework is released under the GNU Public License, version 3 or later.
	|*|  http://www.gnu.org/licenses/gpl-3.0-standalone.html
	|*|
	|*|  Syntaxes:
	|*|
	|*|  * docCookies.setItem(name, value[, end[, path[, domain[, secure]]]])
	|*|  * docCookies.getItem(name)
	|*|  * docCookies.removeItem(name[, path[, domain]])
	|*|  * docCookies.hasItem(name)
	|*|  * docCookies.keys()
	|*|
	\*/
	_docCookies = {
		getItem: function (sKey) {
			if (!sKey) {
				return null;
			}
			return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
		},
		setItem: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
			if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) {
				return false;
			}
			var sExpires = "";
			if (vEnd) {
				switch (vEnd.constructor) {
					case Number:
						sExpires = vEnd === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + vEnd;
						break;
					case String:
						sExpires = "; expires=" + vEnd;
						break;
					case Date:
						sExpires = "; expires=" + vEnd.toUTCString();
						break;
				}
			}
			document.cookie = encodeURIComponent(sKey) + "=" + encodeURIComponent(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
			return true;
		},
		removeItem: function (sKey, sPath, sDomain) {
			if (!this.hasItem(sKey)) {
				return false;
			}
			document.cookie = encodeURIComponent(sKey) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "");
			return true;
		},
		hasItem: function (sKey) {
			if (!sKey) {
				return false;
			}
			return (new RegExp("(?:^|;\\s*)" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
		},
		keys: function () {
			var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
			for (var nLen = aKeys.length, nIdx = 0; nIdx < nLen; nIdx++) {
				aKeys[nIdx] = decodeURIComponent(aKeys[nIdx]);
			}
			return aKeys;
		}
	};

	jStyleSwitcher = function ($root, config) {
		return this.init($root, config);
	};

	jStyleSwitcher.prototype = {

		/**
		 * {Object} DOM reference to style option list
		 */
		$root: null,

		/**
		 * {Object} configs for the style switcher
		 */
		config: {},

		/**
		 * {Object} jQuery reference to <link> tag for swapping CSS
		 */
		$themeCss: null,
		
		/**
		 * {String} default theme page was loaded with
		 */
		defaultTheme: null,

		init: function ($root, config) {
			this.$root = $root;
			this.config = config ? config : {};
			this.setDefaultTheme();
			if(this.defaultTheme) {
				// try cookies
				if (this.config.cookie) {
					this.checkCookie();
				}
				// try hover
				if (this.config.hasPreview) {
					this.addHoverEvents();
				}
				// finally, add click events
				this.addClickEvents();
			} else {
				this.$root.addClass('jssError error level0');
			}
		},

		setDefaultTheme: function () {
			this.$themeCss = $('link[id=' + this.config.defaultThemeId + ']');
			if(this.$themeCss.length) {
				this.defaultTheme = this.$themeCss.attr('href');
			}
		},
		
		resetStyle: function() {
			this.updateStyle(this.defaultTheme);
		},
		
		updateStyle: function(newStyle) {
			this.$themeCss.attr('href', newStyle);
		},
		
		getFullAssetPath: function(asset) {
			return this.config.fullPath + asset + '.css';
		},

		checkCookie: function () {
			var styleCookie;
			// if using cookies and using JavaScript to load css
			if (this.config.cookie && this.config.cookie.isManagingLoad) {
				// check if css is set in cookie
				styleCookie = _docCookies.getItem(_cookieKey);
				if (styleCookie) {
					newStyle = this.getFullAssetPath(styleCookie);
					// update link tag
					this.updateStyle(newStyle);
					// update default ref
					this.defaultTheme = newStyle;
				}
			}
		},

		addHoverEvents: function () {
			var self = this;
			this.$root.find('a').hover(
				function () {
					var asset = $(this).data('theme'),
						newStyle = self.getFullAssetPath(asset);
					// update link tag
					self.updateStyle(newStyle);
				},
				function () {
					// reset link tag
					self.resetStyle();
				}
			);
		},

		addClickEvents: function () {
			var self = this;
			this.$root.find('a').click(
				function () {
					var asset = $(this).data('theme'),
						newStyle = self.getFullAssetPath(asset);
					// update link tag
					self.updateStyle(newStyle);
					// update default ref
					self.defaultTheme = newStyle;
					// try to store cookie
					if (self.config.cookie) {
						_docCookies.setItem(_cookieKey, asset, self.config.cookie.expires, '/');
					}
				}
			);
		}
	};

	$.fn.styleSwitcher = function (options) {
		return new jStyleSwitcher(this, $.extend(true, _defaultOptions, options));
	};
})(jQuery);ction(a){var b={basic:{type:"basic",method:function(a){return a},cssClass:""},description:{type:"description",fields:{description:"description"},method:function(a){return a+" - description"},cssClass:"eac-description"},iconLeft:{type:"iconLeft",fields:{icon:""},method:function(a){return a},cssClass:"eac-icon-left"},iconRight:{type:"iconRight",fields:{iconSrc:""},method:function(a){return a},cssClass:"eac-icon-right"},links:{type:"links",fields:{link:""},method:function(a){return a},cssClass:""},custom:{type:"custom",method:function(){},cssClass:""}},c=function(a){var c,d=a.fields;return"description"===a.type?(c=b.description.method,"string"==typeof d.description?c=function(a,b){return a+" - <span>"+b[d.description]+"</span>"}:"function"==typeof d.description&&(c=function(a,b){return a+" - <span>"+d.description(b)+"</span>"}),c):"iconRight"===a.type?("string"==typeof d.iconSrc?c=function(a,b){return a+"<img class='eac-icon' src='"+b[d.iconSrc]+"' />"}:"function"==typeof d.iconSrc&&(c=function(a,b){return a+"<img class='eac-icon' src='"+d.iconSrc(b)+"' />"}),c):"iconLeft"===a.type?("string"==typeof d.iconSrc?c=function(a,b){return"<img class='eac-icon' src='"+b[d.iconSrc]+"' />"+a}:"function"==typeof d.iconSrc&&(c=function(a,b){return"<img class='eac-icon' src='"+d.iconSrc(b)+"' />"+a}),c):"links"===a.type?("string"==typeof d.link?c=function(a,b){return"<a href='"+b[d.link]+"' >"+a+"</a>"}:"function"==typeof d.link&&(c=function(a,b){return"<a href='"+d.link(b)+"' >"+a+"</a>"}),c):"custom"===a.type?a.method:b.basic.method},d=function(a){return a&&a.type&&a.type&&b[a.type]?c(a):b.basic.method},e=function(a){var c=function(){return""};return a&&a.type&&a.type&&b[a.type]?function(){var c=b[a.type].cssClass;return function(){return c}}():c};this.getTemplateClass=e(a),this.build=d(a)},a}(EasyAutocomplete||{}),EasyAutocomplete=function(a){return a.main=function(b,c){function d(){return 0===t.length?void p.error("Input field doesn't exist."):o.checkDataUrlProperties()?o.checkRequiredProperties()?(e(),void g()):void p.error("Will not work without mentioned properties."):void p.error("One of options variables 'data' or 'url' must be defined.")}function e(){function a(){var a=$("<div>"),c=n.getValue("WRAPPER_CSS_CLASS");o.get("theme")&&""!==o.get("theme")&&(c+=" eac-"+o.get("theme")),o.get("cssClasses")&&""!==o.get("cssClasses")&&(c+=" "+o.get("cssClasses")),""!==q.getTemplateClass()&&(c+=" "+q.getTemplateClass()),a.addClass(c),t.wrap(a),o.get("adjustWidth")===!0&&b()}function b(){var a=t.outerWidth();t.parent().css("width",a)}function c(){t.unwrap()}function d(){var a=$("<div>").addClass(n.getValue("CONTAINER_CLASS"));a.attr("id",f()).prepend($("<ul>")),function(){a.on("show.eac",function(){switch(o.get("list").showAnimation.type){case"slide":var b=o.get("list").showAnimation.time,c=o.get("list").showAnimation.callback;a.find("ul").slideDown(b,c);break;case"fade":var b=o.get("list").showAnimation.time,c=o.get("list").showAnimation.callback;a.find("ul").fadeIn(b),c;break;default:a.find("ul").show()}o.get("list").onShowListEvent()}).on("hide.eac",function(){switch(o.get("list").hideAnimation.type){case"slide":var b=o.get("list").hideAnimation.time,c=o.get("list").hideAnimation.callback;a.find("ul").slideUp(b,c);break;case"fade":var b=o.get("list").hideAnimation.time,c=o.get("list").hideAnimation.callback;a.find("ul").fadeOut(b,c);break;default:a.find("ul").hide()}o.get("list").onHideListEvent()}).on("selectElement.eac",function(){a.find("ul li").removeClass("selected"),a.find("ul li").eq(w).addClass("selected"),o.get("list").onSelectItemEvent()}).on("loadElements.eac",function(b,c,d){var e="",f=a.find("ul");f.empty().detach(),v=[];for(var h=0,i=0,k=c.length;k>i;i+=1){var l=c[i].data;if(0!==l.length){void 0!==c[i].header&&c[i].header.length>0&&f.append("<div class='eac-category' >"+c[i].header+"</div>");for(var m=0,n=l.length;n>m&&h<c[i].maxListSize;m+=1)e=$("<li><div class='eac-item'></div></li>"),function(){var a=m,b=h,f=c[i].getValue(l[a]);e.find(" > div").on("click",function(){t.val(f).trigger("change"),w=b,j(b),o.get("list").onClickEvent(),o.get("list").onChooseEvent()}).mouseover(function(){w=b,j(b),o.get("list").onMouseOverEvent()}).mouseout(function(){o.get("list").onMouseOutEvent()}).html(q.build(g(f,d),l[a]))}(),f.append(e),v.push(l[m]),h+=1}}a.append(f),o.get("list").onLoadEvent()})}(),t.after(a)}function e(){t.next("."+n.getValue("CONTAINER_CLASS")).remove()}function g(a,b){return o.get("highlightPhrase")&&""!==b?i(a,b):a}function h(a){return a.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g,"\\$&")}function i(a,b){var c=h(b);return(a+"").replace(new RegExp("("+c+")","gi"),"<b>$1</b>")}t.parent().hasClass(n.getValue("WRAPPER_CSS_CLASS"))&&(e(),c()),a(),d(),u=$("#"+f()),o.get("placeholder")&&t.attr("placeholder",o.get("placeholder"))}function f(){var a=t.attr("id");return a=n.getValue("CONTAINER_ID")+a}function g(){function a(){s("autocompleteOff",!0)&&n(),b(),c(),d(),e(),f(),g()}function b(){t.focusout(function(){var a,b=t.val();o.get("list").match.caseSensitive||(b=b.toLowerCase());for(var c=0,d=v.length;d>c;c+=1)if(a=o.get("getValue")(v[c]),o.get("list").match.caseSensitive||(a=a.toLowerCase()),a===b)return w=c,void j(w)})}function c(){t.off("keyup").keyup(function(a){function b(a){function b(){var a={},b=o.get("ajaxSettings")||{};for(var c in b)a[c]=b[c];return a}function c(a,b){return o.get("matchResponseProperty")!==!1?"string"==typeof o.get("matchResponseProperty")?b[o.get("matchResponseProperty")]===a:"function"==typeof o.get("matchResponseProperty")?o.get("matchResponseProperty")(b)===a:!0:!0}if(!(a.length<o.get("minCharNumber"))){if("list-required"!==o.get("data")){var d=o.get("data"),e=r.init(d);e=r.updateCategories(e,d),e=r.processData(e,a),k(e,a),t.parent().find("li").length>0?h():i()}var f=b();void 0!==f.url&&""!==f.url||(f.url=o.get("url")),void 0!==f.dataType&&""!==f.dataType||(f.dataType=o.get("dataType")),void 0!==f.url&&"list-required"!==f.url&&(f.url=f.url(a),f.data=o.get("preparePostData")(f.data,a),$.ajax(f).done(function(b){var d=r.init(b);d=r.updateCategories(d,b),d=r.convertXml(d),c(a,b)&&(d=r.processData(d,a),k(d,a)),r.checkIfDataExists(d)&&t.parent().find("li").length>0?h():i(),o.get("ajaxCallback")()}).fail(function(){p.warning("Fail to load response data")}).always(function(){}))}}switch(a.keyCode){case 27:i(),l();break;case 38:a.preventDefault(),v.length>0&&w>0&&(w-=1,t.val(o.get("getValue")(v[w])),j(w));break;case 40:a.preventDefault(),v.length>0&&w<v.length-1&&(w+=1,t.val(o.get("getValue")(v[w])),j(w));break;default:if(a.keyCode>40||8===a.keyCode){var c=t.val();o.get("list").hideOnEmptyPhrase!==!0||8!==a.keyCode||""!==c?o.get("requestDelay")>0?(void 0!==m&&clearTimeout(m),m=setTimeout(function(){b(c)},o.get("requestDelay"))):b(c):i()}}})}function d(){t.on("keydown",function(a){a=a||window.event;var b=a.keyCode;return 38===b?(suppressKeypress=!0,!1):void 0}).keydown(function(a){13===a.keyCode&&w>-1&&(t.val(o.get("getValue")(v[w])),o.get("list").onKeyEnterEvent(),o.get("list").onChooseEvent(),w=-1,i(),a.preventDefault())})}function e(){t.off("keypress")}function f(){t.focus(function(){""!==t.val()&&v.length>0&&(w=-1,h())})}function g(){t.blur(function(){setTimeout(function(){w=-1,i()},250)})}function n(){t.attr("autocomplete","off")}a()}function h(){u.trigger("show.eac")}function i(){u.trigger("hide.eac")}function j(a){u.trigger("selectElement.eac",a)}function k(a,b){u.trigger("loadElements.eac",[a,b])}function l(){t.trigger("blur")}var m,n=new a.Constans,o=new a.Configuration(c),p=new a.Logger,q=new a.Template(c.template),r=new a.ListBuilderService(o,a.proccess),s=o.equals,t=b,u="",v=[],w=-1;a.consts=n,this.getConstants=function(){return n},this.getConfiguration=function(){return o},this.getContainer=function(){return u},this.getSelectedItemIndex=function(){return w},this.getItems=function(){return v},this.getItemData=function(a){return v.length<a||void 0===v[a]?-1:v[a]},this.getSelectedItemData=function(){return this.getItemData(w)},this.build=function(){e()},this.init=function(){d()}},a.eacHandles=[],a.getHandle=function(b){return a.eacHandles[b]},a.inputHasId=function(a){return void 0!==$(a).attr("id")&&$(a).attr("id").length>0},a.assignRandomId=function(b){var c="";do c="eac-"+Math.floor(1e4*Math.random());while(0!==$("#"+c).length);elementId=a.consts.getValue("CONTAINER_ID")+c,$(b).attr("id",c)},a.setHandle=function(b,c){a.eacHandles[c]=b},a}(EasyAutocomplete||{});!function(a){a.fn.easyAutocomplete=function(b){return this.each(function(){var c=a(this),d=new EasyAutocomplete.main(c,b);EasyAutocomplete.inputHasId(c)||EasyAutocomplete.assignRandomId(c),d.init(),EasyAutocomplete.setHandle(d,c.attr("id"))})},a.fn.getSelectedItemIndex=function(){var b=a(this).attr("id");return void 0!==b?EasyAutocomplete.getHandle(b).getSelectedItemIndex():-1},a.fn.getItems=function(){var b=a(this).attr("id");return void 0!==b?EasyAutocomplete.getHandle(b).getItems():-1},a.fn.getItemData=function(b){var c=a(this).attr("id");return void 0!==c&&b>-1?EasyAutocomplete.getHandle(c).getItemData(b):-1},a.fn.getSelectedItemData=function(){var b=a(this).attr("id");return void 0!==b?EasyAutocomplete.getHandle(b).getSelectedItemData():-1}}(jQuery);