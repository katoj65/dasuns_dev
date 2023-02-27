"use strict";function ownKeys(t,e){var i=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);e&&(s=s.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i.push.apply(i,s)}return i}function _objectSpread(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?ownKeys(i,!0).forEach((function(e){_defineProperty(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):ownKeys(i).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}function _defineProperty(t,e,i){return e in t?Object.defineProperty(t,e,{value:i,enumerable:!0,configurable:!0,writable:!0}):t[e]=i,t}function _toConsumableArray(t){return _arrayWithoutHoles(t)||_iterableToArray(t)||_nonIterableSpread()}function _nonIterableSpread(){throw new TypeError("Invalid attempt to spread non-iterable instance")}function _iterableToArray(t){if(Symbol.iterator in Object(t)||"[object Arguments]"===Object.prototype.toString.call(t))return Array.from(t)}function _arrayWithoutHoles(t){if(Array.isArray(t)){for(var e=0,i=new Array(t.length);e<t.length;e++)i[e]=t[e];return i}}!function(t){t.fn.tagify=function(){var e=0<arguments.length&&void 0!==arguments[0]?arguments[0]:{};return this.each((function(){var i,s=t(this);if(s.data("tagify"))return this;e.isJQueryPlugin=!0,i=new n(s[0],e),s.data("tagify",i)}))};var e="undefined"!=typeof InstallTrigger;function i(t){var e=Object.prototype.toString.call(t).split(" ")[1].slice(0,-1);return t===Object(t)&&"Array"!=e&&"Function"!=e&&"RegExp"!=e&&"HTMLUnknownElement"!=e}function s(t){var e=document.createElement("div");return t.replace(/\&#?[0-9a-z]+;/gi,(function(t){return e.innerHTML=t,e.innerText}))}function n(t,e){if(!t)return console.warn("Tagify: ","invalid input element ",t),this;this.applySettings(t,e||{}),this.state={editing:!1,actions:{},dropdown:{}},this.value=[],this.listeners={},this.DOM={},this.extend(this,new this.EventDispatcher(this)),this.build(t),this.getCSSVars(),this.loadOriginalValues(),this.events.customBinding.call(this),this.events.binding.call(this),t.autofocus&&this.DOM.input.focus()}n.prototype={isIE:window.document.documentMode,TEXTS:{empty:"empty",exceed:"number of tags exceeded",pattern:"pattern mismatch",duplicate:"already exists",notAllowed:"not allowed"},DEFAULTS:{delimiters:",",pattern:null,maxTags:1/0,callbacks:{},addTagOnBlur:!0,duplicates:!1,whitelist:[],blacklist:[],enforceWhitelist:!1,keepInvalidTags:!1,mixTagsAllowedAfter:/,|\.|\:|\s/,mixTagsInterpolator:["[[","]]"],backspace:!0,skipInvalid:!1,editTags:2,transformTag:function(){},autoComplete:{enabled:!0,rightKey:!1},dropdown:{classname:"",enabled:2,maxItems:10,searchKeys:[],fuzzySearch:!0,highlightFirst:!1,closeOnSelect:!0,position:"all"}},templates:{wrapper:function(t,e){return'<tags class="tagify '.concat(e.mode?"tagify--"+e.mode:""," ").concat(t.className,'"\n                        ').concat(e.readonly?'readonly aria-readonly="true"':'aria-haspopup="listbox" aria-expanded="false"','\n                        role="tagslist"\n                        tabIndex="-1">\n                <span contenteditable data-placeholder="').concat(e.placeholder||"&#8203;",'" aria-placeholder="').concat(e.placeholder||"",'"\n                    class="tagify__input"\n                    role="textbox"\n                    aria-autocomplete="both"\n                    aria-multiline="').concat("mix"==e.mode,'"></span>\n            </tags>')},tag:function(t,e){return'<tag title="'.concat(e.title||t,"\"\n                        contenteditable='false'\n                        spellcheck='false'\n                        tabIndex=\"-1\"\n                        class=\"tagify__tag ").concat(e.class?e.class:"",'"\n                        ').concat(this.getAttributes(e),">\n                <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>\n                <div>\n                    <span class='tagify__tag-text'>").concat(t,"</span>\n                </div>\n            </tag>")},dropdownItem:function(t){var e=this.settings.dropdown.mapValueTo,i=((e?"function"==typeof e?e(t):t[e]:t.value)||t.value||t).replace(/`|'/g,"&#39;");return"<div ".concat(this.getAttributes(t),"\n                        class='tagify__dropdown__item ").concat(t.class?t.class:"",'\'\n                        tabindex="0"\n                        role="option">').concat(i,"</div>")}},customEventsList:["add","remove","invalid","input","click","keydown","focus","blur","edit:input","edit:updated","edit:start","edit:keydown","dropdown:show","dropdown:hide","dropdown:select"],applySettings:function(t,e){var s=this;if(this.DEFAULTS.templates=this.templates,this.settings=this.extend({},this.DEFAULTS,e),this.settings.readonly=t.hasAttribute("readonly"),this.settings.placeholder=t.getAttribute("placeholder")||this.settings.placeholder||"",this.isIE&&(this.settings.autoComplete=!1),["whitelist","blacklist"].forEach((function(e){var i=t.getAttribute("data-"+e);i&&(i=i.split(s.settings.delimiters))instanceof Array&&(s.settings[e]=i)})),"autoComplete"in e&&!i(e.autoComplete)&&(this.settings.autoComplete=this.DEFAULTS.autoComplete,this.settings.autoComplete.enabled=e.autoComplete),t.pattern)try{this.settings.pattern=new RegExp(t.pattern)}catch(e){}if(this.settings.delimiters)try{this.settings.delimiters=new RegExp(this.settings.delimiters,"g")}catch(e){}"select"==this.settings.mode&&(this.settings.dropdown.enabled=0),"mix"==this.settings.mode&&(this.settings.autoComplete.rightKey=!0)},getAttributes:function(t){if("[object Object]"!=Object.prototype.toString.call(t))return"";var e,i,s=Object.keys(t),n="";for(i=s.length;i--;)"class"!=(e=s[i])&&t.hasOwnProperty(e)&&t[e]&&(n+=" "+e+(t[e]?'="'.concat(t[e],'"'):""));return n},parseHTML:function(t){return(new DOMParser).parseFromString(t.trim(),"text/html").body.firstElementChild},getCaretGlobalPosition:function(){var t=document.getSelection();if(t.rangeCount){var e,i,s=t.getRangeAt(0),n=s.startContainer,a=s.startOffset;if(0<a)return(i=document.createRange()).setStart(n,a-1),i.setEnd(n,a),{left:(e=i.getBoundingClientRect()).right,top:e.top,bottom:e.bottom}}return{left:-9999,top:-9999}},getCSSVars:function(){var t,e,i=getComputedStyle(this.DOM.scope,null);this.CSSVars={tagHideTransition:(t=function(t){if(!t)return{};var e=(t=t.trim().split(" ")[0]).split(/\d+/g).filter((function(t){return t})).pop().trim();return{value:+t.split(e).filter((function(t){return t}))[0].trim(),unit:e}}(("tag-hide-transition",i.getPropertyValue("--tag-hide-transition"))),e=t.value,"s"==t.unit?1e3*e:e)}},build:function(t){var e=this.DOM,i=this.settings.templates.wrapper(t,this.settings);e.originalInput=t,e.scope=this.parseHTML(i),e.input=e.scope.querySelector("[contenteditable]"),t.parentNode.insertBefore(e.scope,t),0<=this.settings.dropdown.enabled&&this.dropdown.init.call(this)},destroy:function(){this.DOM.scope.parentNode.removeChild(this.DOM.scope),this.dropdown.hide.call(this,!0),clearTimeout(this.dropdownHide__bindEventsTimeout)},loadOriginalValues:function(t){if(t=t||this.DOM.originalInput.value)if(this.removeAllTags(),"mix"==this.settings.mode)this.parseMixTags(t.trim());else{try{"string"!=typeof JSON.parse(t)&&(t=JSON.parse(t))}catch(t){}this.addTags(t).forEach((function(t){return t&&t.classList.add("tagify--noAnim")}))}},extend:function(t,e,s){function n(t,e){for(var s in e)e.hasOwnProperty(s)&&(i(e[s])?i(t[s])?n(t[s],e[s]):t[s]=Object.assign({},e[s]):t[s]=e[s])}return t instanceof Object||(t={}),n(t,e),s&&n(t,s),t},cloneEvent:function(t){var e={};for(var i in t)e[i]=t[i];return e},EventDispatcher:function(t){var e=document.createTextNode("");function i(t,i,s){s&&i.split(/\s+/g).forEach((function(i){return e[t+"EventListener"].call(e,i,s)}))}this.off=function(t,e){return i("remove",t,e),this},this.on=function(t,e){return e&&"function"==typeof e&&i("add",t,e),this},this.trigger=function(i,s){var n;if(i)if(t.settings.isJQueryPlugin)"remove"==i&&(i="removeTag"),jQuery(t.DOM.originalInput).triggerHandler(i,[s]);else{try{n=new CustomEvent(i,{detail:this.extend({},s,{tagify:this})})}catch(i){console.warn(i)}e.dispatchEvent(n)}}},loading:function(t){return this.DOM.scope.classList[t?"add":"remove"]("tagify--loading"),this},toggleFocusClass:function(t){this.DOM.scope.classList.toggle("tagify--focus",!!t)},events:{customBinding:function(){var t=this;this.customEventsList.forEach((function(e){t.on(e,t.settings.callbacks[e])}))},binding:function(t){var e,i=!(0<arguments.length&&void 0!==t)||t,s=this.events.callbacks,n=i?"addEventListener":"removeEventListener";if(!this.state.mainEvents||!i)for(var a in(this.state.mainEvents=i)&&!this.listeners.main&&(this.DOM.input.addEventListener(this.isIE?"keydown":"input",s[this.isIE?"onInputIE":"onInput"].bind(this)),this.settings.isJQueryPlugin&&jQuery(this.DOM.originalInput).on("tagify.removeAllTags",this.removeAllTags.bind(this))),e=this.listeners.main=this.listeners.main||{focus:["input",s.onFocusBlur.bind(this)],blur:["input",s.onFocusBlur.bind(this)],keydown:["input",s.onKeydown.bind(this)],click:["scope",s.onClickScope.bind(this)],dblclick:["scope",s.onDoubleClickScope.bind(this)]}){if("blur"==a&&!i)return;this.DOM[e[a][0]][n](a,e[a][1])}},callbacks:{onFocusBlur:function(t){var e=t.target?t.target.textContent.trim():"",i=this.settings,s=t.type,n={relatedTarget:t.relatedTarget};if(!(t.relatedTarget&&t.relatedTarget.classList.contains("tagify__tag")&&this.DOM.scope.contains(t.relatedTarget))){if("blur"==s&&t.relatedTarget===this.DOM.scope)return this.dropdown.hide.call(this),void this.DOM.input.focus();if(!this.state.actions.selectOption||!i.dropdown.enabled&&i.dropdown.closeOnSelect)if(this.state.hasFocus="focus"==s&&+new Date,this.toggleFocusClass(this.state.hasFocus),this.setRangeAtStartEnd(!1),"mix"!=i.mode){if("focus"==s)return this.trigger("focus",n),void(0===i.dropdown.enabled&&"select"!=i.mode&&this.dropdown.show.call(this));"blur"==s&&(this.trigger("blur",n),this.loading(!1),("select"==this.settings.mode?!this.value.length||this.value[0].value!=e:e&&!this.state.actions.selectOption&&i.addTagOnBlur)&&this.addTags(e,!0)),this.DOM.input.removeAttribute("style"),this.dropdown.hide.call(this)}else"focus"==s?this.trigger("focus",n):"blur"==t.type&&(this.trigger("blur",n),this.loading(!1),this.dropdown.hide.call(this))}},onKeydown:function(t){var e=this,i=t.target.textContent.trim();if(this.trigger("keydown",{originalEvent:this.cloneEvent(t)}),"mix"==this.settings.mode){switch(t.key){case"Left":case"ArrowLeft":this.state.actions.ArrowLeft=!0;break;case"Delete":case"Backspace":if(this.state.editing)return;var n=document.getSelection(),a=s(this.DOM.input.innerHTML),o=this.getTagElms();3==n.anchorNode.nodeType&&!n.anchorNode.nodeValue&&n.anchorNode.previousElementSibling&&t.preventDefault(),setTimeout((function(){if(s(e.DOM.input.innerHTML).length>=a.length&&(e.removeTag(n.anchorNode.previousElementSibling),2==e.DOM.input.children.length&&"BR"==e.DOM.input.children[1].tagName))return e.DOM.input.innerHTML="",!(e.value.length=0);e.value=[].map.call(o,(function(t,i){var s=t.__tagifyTagData;if(t.parentNode)return s;e.trigger("remove",{tag:t,index:i,data:s})})).filter((function(t){return t}))}),50)}return!0}switch(t.key){case"Backspace":this.state.dropdown.visible||""!=i&&8203!=i.charCodeAt(0)||(!0===this.settings.backspace?this.removeTag():"edit"==this.settings.backspace&&setTimeout(this.editTag.bind(this),0));break;case"Esc":case"Escape":if(this.state.dropdown.visible)return;t.target.blur();break;case"Down":case"ArrowDown":this.state.dropdown.visible||this.dropdown.show.call(this);break;case"ArrowRight":var r=this.state.inputSuggestion||this.state.ddItemData;if(r&&this.settings.autoComplete.rightKey)return void this.addTags([r],!0);break;case"Tab":if(!i||"select"==this.settings.mode)return!0;case"Enter":t.preventDefault(),setTimeout((function(){e.state.actions.selectOption||e.addTags(i,!0)}))}},onInput:function(t){var e="mix"==this.settings.mode?this.DOM.input.textContent:this.input.normalize.call(this),i=e.length>=this.settings.dropdown.enabled,s={value:e,inputElm:this.DOM.input};if("mix"==this.settings.mode)return this.events.callbacks.onMixTagsInput.call(this,t);s.isValid=this.validateTag({value:e}),this.trigger("input",s),e?this.input.value!=e&&(this.input.set.call(this,e,!1),-1!=e.search(this.settings.delimiters)?this.addTags(e)&&this.input.set.call(this):0<=this.settings.dropdown.enabled&&this.dropdown[i?"show":"hide"].call(this,e)):this.input.set.call(this,"")},onMixTagsInput:function(){var t,e,i,s,n,a=this,o=this.settings;return this.value.length<this.getTagElms().length?(this.value=[].map.call(this.getTagElms(),(function(t){return t.__tagifyTagData})),void this.update()):!!this.hasMaxTags()||(window.getSelection&&0<(n=window.getSelection()).rangeCount&&3==n.anchorNode.nodeType&&((t=n.getRangeAt(0).cloneRange()).collapse(!0),t.setStart(n.focusNode,0),(i=(e=t.toString().split(o.mixTagsAllowedAfter))[e.length-1].match(o.pattern))&&(this.state.actions.ArrowLeft=!1,this.state.tag={prefix:i[0],value:i.input.split(i[0])[1]},s=this.state.tag.value.length>=o.dropdown.enabled)),void setTimeout((function(){a.update(),a.trigger("input",a.extend({},a.state.tag,{textContent:a.DOM.input.textContent})),a.state.tag&&a.dropdown[s?"show":"hide"].call(a,a.state.tag.value)}),10))},onInputIE:function(t){var e=this;setTimeout((function(){e.events.callbacks.onInput.call(e,t)}))},onClickScope:function(t){var e,i=t.target.closest(".tagify__tag"),s=this.settings,n=new Date-this.state.hasFocus;if(t.target!=this.DOM.scope){if(!t.target.classList.contains("tagify__tag__removeBtn"))return i?(e=this.getNodeIndex(i),this.trigger("click",{tag:i,index:e,data:this.value[e],originalEvent:this.cloneEvent(t)}),void(1==this.settings.editTags&&this.events.callbacks.onDoubleClickScope.call(this,t))):void(t.target==this.DOM.input&&500<n?this.state.dropdown.visible?this.dropdown.hide.call(this):0===s.dropdown.enabled&&"mix"!=s.mode&&this.dropdown.show.call(this):"select"==s.mode&&(this.state.dropdown.visible||this.dropdown.show.call(this)));this.removeTag(t.target.parentNode)}else this.DOM.input.focus()},onEditTagInput:function(t,e){var i=t.closest("tag"),s=this.getNodeIndex(i),n=this.input.normalize.call(this,t),a=this.validateTag({value:n});i.classList.toggle("tagify--invalid",!0!==a),i.__tagifyTagData.__isValid=a,n.length>=this.settings.dropdown.enabled&&(this.state.editing.value=n,this.dropdown.show.call(this,n)),this.trigger("edit:input",{tag:i,index:s,data:this.extend({},this.value[s],{newValue:n}),originalEvent:this.cloneEvent(e)})},onEditTagFocus:function(t){this.state.editing={scope:t,input:t.querySelector("[contenteditable]")}},onEditTagBlur:function(t){if(this.state.hasFocus||this.toggleFocusClass(),this.DOM.scope.contains(t)){var e=t.closest(".tagify__tag"),i=this.input.normalize.call(this,t),s=i,n=s!=t.originalValue,a=this.extend({},e.__tagifyTagData,{value:s}),o=this.validateTag(a);if(!i)return this.removeTag(e),void this.onEditTagDone(null,a);n?(this.settings.transformTag.call(this,a),!0===(o=this.validateTag(a))?this.onEditTagDone(e,a):this.trigger("invalid",{data:a,tag:e,message:o})):this.onEditTagDone(e,a)}},onEditTagkeydown:function(t,e){switch(this.trigger("edit:keydown",{originalEvent:this.cloneEvent(t)}),t.key){case"Esc":case"Escape":t.target.textContent=t.target.originalValue,e.__tagifyTagData=e.__tagifyTagData.__originalData;case"Enter":case"Tab":t.preventDefault(),t.target.blur()}},onDoubleClickScope:function(t){var e,i,s=t.target.closest("tag"),n=this.settings;s&&(e=s.classList.contains("tagify__tag--editable"),i=s.hasAttribute("readonly"),"select"==n.mode||n.readonly||e||i||!this.settings.editTags||this.editTag(s),this.toggleFocusClass(!0))}}},editTag:function(t,e){var i=this;e=e||{};var s=(t=t||this.getLastTag()).querySelector(".tagify__tag-text"),n=this.getNodeIndex(t),a=t.__tagifyTagData,o=this.events.callbacks,r=this,l=!0;if(s){if(!(a instanceof Object&&"editable"in a)||a.editable)return t.__tagifyTagData.__originalData=this.extend({},a),t.classList.add("tagify__tag--editable"),s.originalValue=s.textContent,s.setAttribute("contenteditable",!0),s.addEventListener("focus",o.onEditTagFocus.bind(this,t)),s.addEventListener("blur",(function(){r.state.editing=!1,setTimeout(o.onEditTagBlur.bind(r),0,s)})),s.addEventListener("input",o.onEditTagInput.bind(this,s)),s.addEventListener("keydown",(function(e){return o.onEditTagkeydown.call(i,e,t)})),s.focus(),this.setRangeAtStartEnd(!1,s),e.skipValidation||(l=this.editTagToggleValidity(t,a.value)),this.trigger("edit:start",{tag:t,index:n,data:a,isValid:l}),this}else console.warn("Cannot find element in Tag template: ",".tagify__tag-text")},editTagToggleValidity:function(t){var e,i=t.__tagifyTagData;if(i)return e=!(!i.__isValid||1==i.__isValid),t.classList.toggle("tagify--invalid",e),i.__isValid;console.warn("tag has no data: ",t,i)},onEditTagDone:function(t,e){e=e||{};var i={tag:t,index:this.getNodeIndex(t),data:e};this.trigger("edit:beforeUpdate",i),delete e.__originalData,t&&(this.editTagToggleValidity(t),this.replaceTag(t,e)),this.trigger("edit:updated",i),this.dropdown.hide.call(this)},replaceTag:function(t,e){var i=this;e&&e.value||(e=t.__tagifyTagData),e.__isValid&&1!=e.__isValid&&this.extend(e,this.getInvaildTagParams(e,e.__isValid));var s=this.createTagElem(e);this.state.editing.locked||(this.state.editing={locked:!0},setTimeout((function(){return delete i.state.editing.locked}),500),t.parentNode.replaceChild(s,t),this.updateValueByDOMTags())},updateValueByDOMTags:function(){var t=this;this.value=[],[].forEach.call(this.getTagElms(),(function(e){e.classList.contains("tagify--notAllowed")||t.value.push(e.__tagifyTagData)})),this.update()},setRangeAtStartEnd:function(t,e){e=(e=e||this.DOM.input).lastChild||e;var i=document.getSelection();i.rangeCount&&["Start","End"].forEach((function(s){return i.getRangeAt(0)["set"+s](e,t?0:e.length)}))},input:{value:"",set:function(t,e){var i=0<arguments.length&&void 0!==t?t:"",s=!(1<arguments.length&&void 0!==e)||e,n=this.settings.dropdown.closeOnSelect;this.input.value=i,s&&(this.DOM.input.innerHTML=i),!i&&n&&setTimeout(this.dropdown.hide.bind(this),20),this.input.autocomplete.suggest.call(this),this.input.validate.call(this)},validate:function(){var t=!this.input.value||this.validateTag({value:this.input.value});"select"==this.settings.mode?this.DOM.scope.classList.toggle("tagify--invalid",!0!==t):this.DOM.input.classList.toggle("tagify__input--invalid",!0!==t)},normalize:function(t){var e=t||this.DOM.input,i=[];e.childNodes.forEach((function(t){return 3==t.nodeType&&i.push(t.nodeValue)})),i=i.join("\n");try{i=i.replace(/(?:\r\n|\r|\n)/g,this.settings.delimiters.source.charAt(0))}catch(t){}return i=i.replace(/\s/g," ").replace(/^\s+/,"")},autocomplete:{suggest:function(t){if(this.settings.autoComplete.enabled){"string"==typeof(t=t||{})&&(t={value:t});var e=t.value||"",i=e.substr(0,this.input.value.length).toLowerCase(),s=e.substring(this.input.value.length);e&&this.input.value&&i==this.input.value.toLowerCase()?(this.DOM.input.setAttribute("data-suggest",s),this.state.inputSuggestion=t):(this.DOM.input.removeAttribute("data-suggest"),delete this.state.inputSuggestion)}},set:function(t){var e=this.DOM.input.getAttribute("data-suggest"),i=t||(e?this.input.value+e:null);return!!i&&("mix"==this.settings.mode?this.replaceTextWithNode(document.createTextNode(this.state.tag.prefix+i)):(this.input.set.call(this,i),this.setRangeAtStartEnd()),this.input.autocomplete.suggest.call(this),this.dropdown.hide.call(this),!0)}}},getNodeIndex:function(t){var e=0;if(t)for(;t=t.previousElementSibling;)e++;return e},getTagElms:function(){return this.DOM.scope.querySelectorAll(".tagify__tag")},getLastTag:function(){var t=this.DOM.scope.querySelectorAll("tag:not(.tagify--hide):not([readonly])");return t[t.length-1]},isTagDuplicate:function(t){return"select"!=this.settings.mode&&this.value.reduce((function(e,i){return t.trim().toLowerCase()===i.value.toLowerCase()?e+1:e}),0)},getTagIndexByValue:function(t){var e=[];return this.getTagElms().forEach((function(i,s){i.textContent.trim().toLowerCase()==t.toLowerCase()&&e.push(s)})),e},getTagElmByValue:function(t){var e=this.getTagIndexByValue(t)[0];return this.getTagElms()[e]},markTagByValue:function(t,e){return!!(e=e||this.getTagElmByValue(t))&&(e.classList.add("tagify--mark"),setTimeout((function(){e.classList.remove("tagify--mark")}),100),e)},isTagBlacklisted:function(t){return t=t.toLowerCase().trim(),this.settings.blacklist.filter((function(e){return t==e.toLowerCase()})).length},isTagWhitelisted:function(t){return this.settings.whitelist.some((function(e){return"string"==typeof t?t.trim().toLowerCase()===(e.value||e).toLowerCase():JSON.stringify(e).toLowerCase()===JSON.stringify(t).toLowerCase()}))},validateTag:function(t){var e=t.value.trim(),i=this.settings,s=!0;return e?i.pattern&&i.pattern instanceof RegExp&&!i.pattern.test(e)?s=this.TEXTS.pattern:!i.duplicates&&this.isTagDuplicate(e)?s=this.TEXTS.duplicate:(this.isTagBlacklisted(e)||i.enforceWhitelist&&!this.isTagWhitelisted(e))&&(s=this.TEXTS.notAllowed):s=this.TEXTS.empty,s},getInvaildTagParams:function(t,e){return{"aria-invalid":!0,class:(t.class||"")+" tagify--notAllowed",title:e}},hasMaxTags:function(){return this.value.length>=this.settings.maxTags&&this.TEXTS.exceed},normalizeTags:function(t){function e(t){return(t+"").split(a).filter((function(t){return t})).map((function(t){return{value:t.trim()}}))}var i,s=this.settings,n=s.whitelist,a=s.delimiters,o=s.mode,r=!!n&&n[0]instanceof Object,l=t instanceof Array,d=l&&t[0]instanceof Object&&"value"in t[0],c=[];if(d)return(i=[]).concat.apply(i,_toConsumableArray(t.map((function(t){return e(t.value).map((function(e){return _objectSpread({},t,{},e)}))}))));if("number"==typeof t&&(t=t.toString()),"string"==typeof t){if(!t.trim())return[];t=e(t)}else if(l){var h;t=(h=[]).concat.apply(h,_toConsumableArray(t.map((function(t){return e(t)}))))}return r&&(t.forEach((function(t){var e=n.filter((function(e){return e.value.toLowerCase()==t.value.toLowerCase()}));e[0]?c.push(e[0]):"mix"!=o&&c.push(t)})),t=c),t},parseMixTags:function(t){var e=this,i=this.settings,s=i.mixTagsInterpolator,n=i.duplicates,a=i.transformTag,o=i.enforceWhitelist,r=[];return t=t.split(s[0]).map((function(t,i){var l,d,c=t.split(s[1]),h=c[0];try{l=JSON.parse(h)}catch(t){l=e.normalizeTags(h)[0]}if(!(1<c.length)||o&&!e.isTagWhitelisted(l.value)||!n&&e.isTagDuplicate(l.value)){if(t)return i?s[0]+t:t}else a.call(e,l),d=e.createTagElem(l),r.push(l),d.classList.add("tagify--noAnim"),c[0]=d.outerHTML,e.value.push(l);return c.join("")})).join(""),this.DOM.input.innerHTML=t,this.DOM.input.appendChild(document.createTextNode("")),this.DOM.input.normalize(),this.getTagElms().forEach((function(t,e){return t.__tagifyTagData=r[e]})),this.update(),t},replaceTextWithNode:function(t,e){if(this.state.tag||e){e=e||this.state.tag.prefix+this.state.tag.value;var i,s,n=this.state.selection||window.getSelection(),a=n.anchorNode;return a.splitText(n.anchorOffset),i=a.nodeValue.lastIndexOf(e),(s=a.splitText(i)).nodeValue=s.nodeValue.replace(e,""),a.parentNode.insertBefore(t,s),this.DOM.input.normalize(),s}},selectTag:function(t,e){return this.input.set.call(this,e.value,!0),this.state.actions.selectOption&&setTimeout(this.setRangeAtStartEnd.bind(this)),this.getLastTag()?this.replaceTag(this.getLastTag(),e):this.appendTag(t),this.value[0]=e,this.trigger("add",{tag:t,data:e}),this.update(),[t]},addEmptyTag:function(){var t={value:""},e=this.createTagElem(t);e.__tagifyTagData=t,this.appendTag(e),this.editTag(e,{skipValidation:!0})},addTags:function(t,e,i){var s,n=this,a=2<arguments.length&&void 0!==i?i:this.settings.skipInvalid,o=[],r=this.settings;return t&&0!=t.length?(t=this.normalizeTags(t),this.state.editing.scope?(t[0].__isValid=!0,this.onEditTagDone(this.state.editing.scope,t[0])):"mix"==r.mode?(r.transformTag.call(this,t[0]),s=this.createTagElem(t[0]),this.replaceTextWithNode(s)||this.DOM.input.appendChild(s),this.DOM.input.appendChild(document.createTextNode("")),setTimeout((function(){return s.classList.add("tagify--noAnim")}),300),t[0].prefix=t[0].prefix||this.state.tag?this.state.tag.prefix:(r.pattern.source||r.pattern)[0],this.value.push(t[0]),this.update(),this.state.tag=null,this.trigger("add",this.extend({},{tag:s},{data:t[0]})),this.DOM.input.appendChild(document.createTextNode("")),s):("select"==r.mode&&(e=!1),this.DOM.input.removeAttribute("style"),t.forEach((function(t){var e,i={};if(t=Object.assign({},t),r.transformTag.call(n,t),t.__isValid=n.hasMaxTags()||n.validateTag(t),!0!==t.__isValid){if(a)return;n.extend(i,n.getInvaildTagParams(t,t.__isValid)),t.__isValid==n.TEXTS.duplicate&&n.markTagByValue(t.value)}if(i.role="tag",t.readonly&&(i["aria-readonly"]=!0),(e=n.createTagElem(n.extend({},t,i))).__tagifyTagData=t,o.push(e),"select"==r.mode)return n.selectTag(e,t);n.appendTag(e),t.__isValid&&!0===t.__isValid?(n.value.push(t),n.update(),n.trigger("add",{tag:e,index:n.value.length-1,data:t})):(n.trigger("invalid",{data:t,index:n.value.length,tag:e,message:t.__isValid}),r.keepInvalidTags||setTimeout((function(){return n.removeTag(e,!0)}),1e3)),n.dropdown.position.call(n)})),t.length&&e&&this.input.set.call(this),this.dropdown.refilter.call(this),o)):("select"==r.mode&&this.removeAllTags(),o)},appendTag:function(t){var e=this.DOM.scope.lastElementChild;e===this.DOM.input?this.DOM.scope.insertBefore(t,e):this.DOM.scope.appendChild(t)},minify:function(t){return t?t.replace(/\>[\r\n ]+\</g,"><").replace(/(<.*?>)|\s+/g,(function(t,e){return e||" "})):""},createTagElem:function(t){var e,i=function(t){return t.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/'/g,"&#039;")}(t.value),s=this.settings.templates.tag.call(this,i,t);return this.settings.readonly&&(t.readonly=!0),s=this.minify(s),(e=this.parseHTML(s)).__tagifyTagData=t,e},reCheckInvalidTags:function(){var t=this,e=this.DOM.scope.querySelectorAll(".tagify__tag.tagify--notAllowed");[].forEach.call(e,(function(e){var i=e.__tagifyTagData,s=e.getAttribute("title")==t.TEXTS.duplicate,n=!0===t.validateTag(i);s&&n&&(i.__isValid=!0,t.replaceTag(e,i))}))},removeTag:function(t,e,i){var s;if(t=t||this.getLastTag(),i=i||this.CSSVars.tagHideTransition,"string"==typeof t&&(t=this.getTagElmByValue(t)),t instanceof HTMLElement){var n=this,a=this.getNodeIndex(t);"select"==this.settings.mode&&(i=0,this.input.set.call(this)),t.classList.contains("tagify--notAllowed")&&(e=!0),i&&10<i?(t.style.width=parseFloat(window.getComputedStyle(t).width)+"px",document.body.clientTop,t.classList.add("tagify--hide"),setTimeout(o,i)):o()}function o(){t.parentNode&&(s=t.__tagifyTagData,t.parentNode.removeChild(t),e?n.settings.keepInvalidTags&&n.trigger("remove",{tag:t,index:a}):(-1<a&&n.value.splice(a,1),n.update(),n.trigger("remove",{tag:t,index:a,data:s}),n.dropdown.refilter.call(n),n.dropdown.position.call(n),n.settings.keepInvalidTags&&n.reCheckInvalidTags()))}},removeAllTags:function(){this.value=[],"mix"==this.settings.mode?this.DOM.input.innerHTML="":Array.prototype.slice.call(this.getTagElms()).forEach((function(t){return t.parentNode.removeChild(t)})),this.dropdown.position.call(this),"select"==this.settings.mode&&this.input.set.call(this),this.update()},removeValueById:function(){},preUpdate:function(){this.DOM.scope.classList.toggle("tagify--hasMaxTags",this.value.length>=this.settings.maxTags),this.DOM.scope.classList.toggle("tagify--noTags",!this.value.length)},update:function(){this.preUpdate();var t=function(t,e){return t.map((function(t){var e={};for(var i in t)"__isValid"!=i&&(e[i]=t[i]);return e}))}(this.value);this.DOM.originalInput.value="mix"==this.settings.mode?this.getMixedTagsAsString(t):this.value.length?JSON.stringify(t):"",this.DOM.originalInput.dispatchEvent(new CustomEvent("change"))},getMixedTagsAsString:function(t){var i="",s=0,n=t,a=this.settings.mixTagsInterpolator;return function t(o){o.childNodes.forEach((function(o){if(1==o.nodeType){if(o.classList.contains("tagify__tag"))return void(i+=a[0]+JSON.stringify(n[s++])+a[1]);e&&"BR"==o.tagName?i+="\r\n":"DIV"==o.tagName&&(i+="\r\n",t(o))}else i+=o.textContent}))}(this.DOM.input),i},getNodeHeight:function(t){var e,i=t.cloneNode(!0);return i.style.cssText="position:fixed; top:-9999px; opacity:0",document.body.appendChild(i),e=i.clientHeight,i.parentNode.removeChild(i),e},dropdown:{init:function(){this.DOM.dropdown=this.dropdown.build.call(this),this.DOM.dropdown.content=this.DOM.dropdown.querySelector(".tagify__dropdown__wrapper")},build:function(){var t=this.settings.dropdown,e=t.position,i=t.classname,s="".concat("manual"==e?"":"tagify__dropdown tagify__dropdown--".concat(e)," ").concat(i).trim();return this.parseHTML('<div class="'.concat(s,'" role="listbox" aria-labelledby="dropdown">\n                        <div class="tagify__dropdown__wrapper"></div>\n                    </div>'))},show:function(t){var e,i,s,n,a=this,o=this.settings,r=window.getSelection(),l="mix"==o.mode&&!o.enforceWhitelist,d=!o.whitelist||!o.whitelist.length,c="manual"==o.dropdown.position;if((!d||l)&&!1!==o.dropdown.enable){if(clearTimeout(this.dropdownHide__bindEventsTimeout),this.suggestedListItems=this.dropdown.filterListItems.call(this,t),!this.suggestedListItems.length){if(!l||this.state.editing.scope)return this.input.autocomplete.suggest.call(this),void this.dropdown.hide.call(this);this.suggestedListItems=[{value:t}]}s=(i=this.suggestedListItems[0]).value||i,o.autoComplete&&0==s.indexOf(t)&&this.input.autocomplete.suggest.call(this,i),e=this.dropdown.createListHTML.call(this,this.suggestedListItems),this.DOM.dropdown.content.innerHTML=this.minify(e),(o.enforceWhitelist&&!c||o.dropdown.highlightFirst)&&this.dropdown.highlightOption.call(this,this.DOM.dropdown.content.children[0]),this.DOM.scope.setAttribute("aria-expanded",!0),this.trigger("dropdown:show",this.DOM.dropdown),this.state.dropdown.visible=t||!0,this.state.selection={anchorOffset:r.anchorOffset,anchorNode:r.anchorNode},this.dropdown.position.call(this),document.body.contains(this.DOM.dropdown)||(c||(this.events.binding.call(this,!1),n=this.getNodeHeight(this.DOM.dropdown),this.DOM.dropdown.classList.add("tagify__dropdown--initial"),this.dropdown.position.call(this,n),document.body.appendChild(this.DOM.dropdown),setTimeout((function(){return a.DOM.dropdown.classList.remove("tagify__dropdown--initial")}))),setTimeout(this.dropdown.events.binding.bind(this)))}},hide:function(t){var e=this.DOM,i=e.scope,s=e.dropdown,n="manual"==this.settings.dropdown.position&&!t;s&&document.body.contains(s)&&!n&&(window.removeEventListener("resize",this.dropdown.position),this.dropdown.events.binding.call(this,!1),clearTimeout(this.dropdownHide__bindEventsTimeout),this.dropdownHide__bindEventsTimeout=setTimeout(this.events.binding.bind(this),250),i.setAttribute("aria-expanded",!1),s.parentNode.removeChild(s),this.state.dropdown.visible=!1,this.state.ddItemData=this.state.ddItemElm=this.state.selection=null,this.trigger("dropdown:hide",s))},refilter:function(){this.suggestedListItems=this.dropdown.filterListItems.call(this,"");var t=this.dropdown.createListHTML.call(this,this.suggestedListItems);this.DOM.dropdown.content.innerHTML=this.minify(t),this.trigger("dropdown:updated",this.DOM.dropdown)},position:function(t){var e,i,s,n,a,o,r=this.DOM.dropdown;this.state.dropdown.visible&&(o="text"==this.settings.dropdown.position?(n=(i=this.getCaretGlobalPosition()).bottom,s=i.top,a=i.left,"auto"):(s=(i=this.DOM.scope.getBoundingClientRect()).top,n=i.bottom-1,a=i.left,i.width+"px"),s=Math.floor(s),n=Math.ceil(n),e=document.documentElement.clientHeight-n<(t||r.clientHeight),r.style.cssText="left:"+(a+window.pageXOffset)+"px; width:"+o+";"+(e?"bottom:"+(document.documentElement.clientHeight-s-window.pageYOffset-2)+"px;":"top: "+(n+window.pageYOffset)+"px"),r.setAttribute("placement",e?"top":"bottom"))},events:{binding:function(t){var e=!(0<arguments.length&&void 0!==t)||t,i=this.dropdown.events.callbacks,s=this.listeners.dropdown=this.listeners.dropdown||{position:this.dropdown.position.bind(this),onKeyDown:i.onKeyDown.bind(this),onMouseOver:i.onMouseOver.bind(this),onMouseLeave:i.onMouseLeave.bind(this),onClick:i.onClick.bind(this),onScroll:i.onScroll.bind(this)},n=e?"addEventListener":"removeEventListener";"manual"!=this.settings.dropdown.position&&(window[n]("resize",s.position),window[n]("keydown",s.onKeyDown)),this.DOM.dropdown[n]("mouseover",s.onMouseOver),this.DOM.dropdown[n]("mouseleave",s.onMouseLeave),this.DOM.dropdown[n]("mousedown",s.onClick),this.DOM.dropdown.content[n]("scroll",s.onScroll),this.DOM[this.listeners.main.click[0]][n]("click",this.listeners.main.click[1])},callbacks:{onKeyDown:function(t){var e=this.DOM.dropdown.querySelector("[class$='--active']"),i=e;switch(t.key){case"ArrowDown":case"ArrowUp":case"Down":case"Up":var s;t.preventDefault(),i=(i=i&&i[("ArrowUp"==t.key||"Up"==t.key?"previous":"next")+"ElementSibling"])||(s=this.DOM.dropdown.content.children)["ArrowUp"==t.key||"Up"==t.key?s.length-1:0],this.dropdown.highlightOption.call(this,i,!0);break;case"Escape":case"Esc":this.dropdown.hide.call(this);break;case"ArrowRight":if(this.state.actions.ArrowLeft)return;case"Tab":if("mix"!=this.settings.mode&&!this.settings.autoComplete.rightKey){try{var n=i?i.textContent:this.suggestedListItems[0].value;this.input.autocomplete.set.call(this,n)}catch(t){}return!1}case"Enter":t.preventDefault(),this.dropdown.selectOption.call(this,e);break;case"Backspace":if("mix"==this.settings.mode||this.state.editing.scope)return;var a=this.input.value.trim();""!=a&&8203!=a.charCodeAt(0)||(!0===this.settings.backspace?this.removeTag():"edit"==this.settings.backspace&&setTimeout(this.editTag.bind(this),0))}},onMouseOver:function(t){var e=t.target.closest(".tagify__dropdown__item");e&&this.dropdown.highlightOption.call(this,e)},onMouseLeave:function(){this.dropdown.highlightOption.call(this)},onClick:function(t){if(0==t.button&&t.target!=this.DOM.dropdown){var e=t.target.closest(".tagify__dropdown__item");this.dropdown.selectOption.call(this,e)}},onScroll:function(t){var e=t.target,i=e.scrollTop/(e.scrollHeight-e.parentNode.clientHeight)*100;this.trigger("dropdown:scroll",{percentage:Math.round(i)})}}},highlightOption:function(t,e){var i,s="tagify__dropdown__item--active";if(this.state.ddItemElm&&(this.state.ddItemElm.classList.remove(s),this.state.ddItemElm.removeAttribute("aria-selected")),!t)return this.state.ddItemData=null,this.state.ddItemElm=null,void this.input.autocomplete.suggest.call(this);i=this.suggestedListItems[this.getNodeIndex(t)],this.state.ddItemData=i,(this.state.ddItemElm=t).classList.add(s),t.setAttribute("aria-selected",!0),e&&(t.parentNode.scrollTop=t.clientHeight+t.offsetTop-t.parentNode.clientHeight),this.settings.autoComplete&&(this.input.autocomplete.suggest.call(this,i),"manual"!=this.settings.dropdown.position&&this.dropdown.position.call(this))},selectOption:function(t){var e=this;if(t){this.state.actions.selectOption=!0,setTimeout((function(){return e.state.actions.selectOption=!1}),50);var i=this.settings.dropdown.closeOnSelect,s=this.suggestedListItems[this.getNodeIndex(t)]||this.input.value;this.trigger("dropdown:select",s),this.addTags([s],!0),this.state.editing||setTimeout((function(){e.DOM.input.focus(),e.toggleFocusClass(!0)})),i&&this.dropdown.hide.call(this)}},filterListItems:function(t){var e,s,n,a,o=this,r=this.settings,l=[],d=r.whitelist,c=r.dropdown.maxItems||1/0,h=r.dropdown.searchKeys.concat(["searchBy","value"]),u=0;if(!t)return(r.duplicates?d:d.filter((function(t){return!o.isTagDuplicate(i(t)?t.value:t)}))).slice(0,c);for(;u<d.length&&(e=d[u]instanceof Object?d[u]:{value:d[u]},n=h.reduce((function(t,i){return t+" "+(e[i]||"")}),"").toLowerCase().indexOf(t.toLowerCase()),s=r.dropdown.fuzzySearch?0<=n:0==n,a=!r.duplicates&&this.isTagDuplicate(i(e)?e.value:e),s&&!a&&c--&&l.push(e),0!=c);u++);return l},createListHTML:function(t){var e=this.settings.templates.dropdownItem.bind(this);return this.minify(t.map(e).join(""))}}}}(jQuery);