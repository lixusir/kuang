var requirejs,require,define;!function(global){var req,s,head,baseElement,dataMain,src,interactiveScript,currentlyAddingScript,mainScript,subPath,version="2.1.11",commentRegExp=/(\/\*([\s\S]*?)\*\/|([^:]|^)\/\/(.*)$)/gm,cjsRequireRegExp=/[^.]\s*require\s*\(\s*["']([^'"\s]+)["']\s*\)/g,jsSuffixRegExp=/\.js$/,currDirRegExp=/^\.\//,op=Object.prototype,ostring=op.toString,hasOwn=op.hasOwnProperty,ap=Array.prototype,apsp=ap.splice,isBrowser=!("undefined"==typeof window||"undefined"==typeof navigator||!window.document),isWebWorker=!isBrowser&&"undefined"!=typeof importScripts,readyRegExp=isBrowser&&"PLAYSTATION 3"===navigator.platform?/^complete$/:/^(complete|loaded)$/,defContextName="_",isOpera="undefined"!=typeof opera&&"[object Opera]"===opera.toString(),contexts={},cfg={},globalDefQueue=[],useInteractive=!1;function isFunction(e){return"[object Function]"===ostring.call(e)}function isArray(e){return"[object Array]"===ostring.call(e)}function each(e,r){var t;if(e)for(t=0;t<e.length&&(!e[t]||!r(e[t],t,e));t+=1);}function eachReverse(e,r){var t;if(e)for(t=e.length-1;-1<t&&(!e[t]||!r(e[t],t,e));--t);}function hasProp(e,r){return hasOwn.call(e,r)}function getOwn(e,r){return hasProp(e,r)&&e[r]}function eachProp(e,r){var t;for(t in e)if(hasProp(e,t)&&r(e[t],t))break}function mixin(t,e,i,n){return e&&eachProp(e,function(e,r){!i&&hasProp(t,r)||(!n||"object"!=typeof e||!e||isArray(e)||isFunction(e)||e instanceof RegExp?t[r]=e:(t[r]||(t[r]={}),mixin(t[r],e,i,n)))}),t}function bind(e,r){return function(){return r.apply(e,arguments)}}function scripts(){return document.getElementsByTagName("script")}function defaultOnError(e){throw e}function getGlobal(e){if(!e)return e;var r=global;return each(e.split("."),function(e){r=r[e]}),r}function makeError(e,r,t,i){var n=new Error(r+"\nhttp://requirejs.org/docs/errors.html#"+e);return n.requireType=e,n.requireModules=i,t&&(n.originalError=t),n}if(void 0===define){if(void 0!==requirejs){if(isFunction(requirejs))return;cfg=requirejs,requirejs=void 0}void 0===require||isFunction(require)||(cfg=require,require=void 0),req=requirejs=function(e,r,t,i){var n,s,o=defContextName;return isArray(e)||"string"==typeof e||(s=e,isArray(r)?(e=r,r=t,t=i):e=[]),s&&s.context&&(o=s.context),n=(n=getOwn(contexts,o))||(contexts[o]=req.s.newContext(o)),s&&n.configure(s),n.require(e,r,t)},req.config=function(e){return req(e)},req.nextTick="undefined"!=typeof setTimeout?function(e){setTimeout(e,4)}:function(e){e()},require=require||req,req.version=version,req.jsExtRegExp=/^\/|:|\?|\.js$/,req.isBrowser=isBrowser,s=req.s={contexts:contexts,newContext:newContext},req({}),each(["toUrl","undef","defined","specified"],function(r){req[r]=function(){var e=contexts[defContextName];return e.require[r].apply(e,arguments)}}),isBrowser&&(head=s.head=document.getElementsByTagName("head")[0],baseElement=document.getElementsByTagName("base")[0],baseElement&&(head=s.head=baseElement.parentNode)),req.onError=defaultOnError,req.createNode=function(e,r,t){var i=e.xhtml?document.createElementNS("http://www.w3.org/1999/xhtml","html:script"):document.createElement("script");return i.type=e.scriptType||"text/javascript",i.charset="utf-8",i.async=!0,i},req.load=function(r,t,i){var e,n=r&&r.config||{};if(isBrowser)return(e=req.createNode(n,t,i)).setAttribute("data-requirecontext",r.contextName),e.setAttribute("data-requiremodule",t),!e.attachEvent||e.attachEvent.toString&&e.attachEvent.toString().indexOf("[native code")<0||isOpera?(e.addEventListener("load",r.onScriptLoad,!1),e.addEventListener("error",r.onScriptError,!1)):(useInteractive=!0,e.attachEvent("onreadystatechange",r.onScriptLoad)),e.src=i,currentlyAddingScript=e,baseElement?head.insertBefore(e,baseElement):head.appendChild(e),currentlyAddingScript=null,e;if(isWebWorker)try{importScripts(i),r.completeLoad(t)}catch(e){r.onError(makeError("importscripts","importScripts failed for "+t+" at "+i,e,[t]))}},isBrowser&&!cfg.skipDataMain&&eachReverse(scripts(),function(e){if(head=head||e.parentNode,dataMain=e.getAttribute("data-main"))return mainScript=dataMain,cfg.baseUrl||(mainScript=(src=mainScript.split("/")).pop(),subPath=src.length?src.join("/")+"/":"./",cfg.baseUrl=subPath),mainScript=mainScript.replace(jsSuffixRegExp,""),req.jsExtRegExp.test(mainScript)&&(mainScript=dataMain),cfg.deps=cfg.deps?cfg.deps.concat(mainScript):[mainScript],!0}),define=function(e,t,r){var i,n;"string"!=typeof e&&(r=t,t=e,e=null),isArray(t)||(r=t,t=null),!t&&isFunction(r)&&(t=[],r.length&&(r.toString().replace(commentRegExp,"").replace(cjsRequireRegExp,function(e,r){t.push(r)}),t=(1===r.length?["require"]:["require","exports","module"]).concat(t))),useInteractive&&(i=currentlyAddingScript||getInteractiveScript())&&(e=e||i.getAttribute("data-requiremodule"),n=contexts[i.getAttribute("data-requirecontext")]),(n?n.defQueue:globalDefQueue).push([e,t,r])},define.amd={jQuery:!0},req.exec=function(text){return eval(text)},req(cfg)}function newContext(c){var t,e,f,p,u,b={waitSeconds:7,baseUrl:"./",paths:{},bundles:{},pkgs:{},shim:{},config:{}},d={},l={},i={},m=[],h={},n={},g={},x=1,v=1;function q(e,r,t){var i,n,s,o,a,c,p,u,d,l,f=r&&r.split("/"),m=f,h=b.map,g=h&&h["*"];if(e&&"."===e.charAt(0)&&(r?(m=f.slice(0,f.length-1),c=(e=e.split("/")).length-1,b.nodeIdCompat&&jsSuffixRegExp.test(e[c])&&(e[c]=e[c].replace(jsSuffixRegExp,"")),function(e){var r,t,i=e.length;for(r=0;r<i;r++)if("."===(t=e[r]))e.splice(r,1),--r;else if(".."===t){if(1===r&&(".."===e[2]||".."===e[0]))break;0<r&&(e.splice(r-1,2),r-=2)}}(e=m.concat(e)),e=e.join("/")):0===e.indexOf("./")&&(e=e.substring(2))),t&&h&&(f||g)){e:for(s=(n=e.split("/")).length;0<s;--s){if(a=n.slice(0,s).join("/"),f)for(o=f.length;0<o;--o)if(i=(i=getOwn(h,f.slice(0,o).join("/")))&&getOwn(i,a)){p=i,u=s;break e}!d&&g&&getOwn(g,a)&&(d=getOwn(g,a),l=s)}!p&&d&&(p=d,u=l),p&&(n.splice(0,u,p),e=n.join("/"))}return getOwn(b.pkgs,e)||e}function w(r){isBrowser&&each(scripts(),function(e){if(e.getAttribute("data-requiremodule")===r&&e.getAttribute("data-requirecontext")===f.contextName)return e.parentNode.removeChild(e),!0})}function k(e){var r=getOwn(b.paths,e);return r&&isArray(r)&&1<r.length&&(r.shift(),f.require.undef(e),f.require([e]),1)}function y(e){var r,t=e?e.indexOf("!"):-1;return-1<t&&(r=e.substring(0,t),e=e.substring(t+1,e.length)),[r,e]}function E(e,r,t,i){var n,s,o,a,c=null,p=r?r.name:null,u=e,d=!0,l="";return e||(d=!1,e="_@r"+(x+=1)),c=(a=y(e))[0],e=a[1],c&&(c=q(c,p,i),s=getOwn(h,c)),e&&(c?l=s&&s.normalize?s.normalize(e,function(e){return q(e,p,i)}):q(e,p,i):(c=(a=y(l=q(e,p,i)))[0],l=a[1],t=!0,n=f.nameToUrl(l))),{prefix:c,name:l,parentMap:r,unnormalized:!!(o=!c||s||t?"":"_unnormalized"+(v+=1)),url:n,originalName:u,isDefine:d,id:(c?c+"!"+l:l)+o}}function j(e){var r=e.id,t=getOwn(d,r);return t=t||(d[r]=new f.Module(e))}function S(e,r,t){var i=e.id,n=getOwn(d,i);!hasProp(h,i)||n&&!n.defineEmitComplete?(n=j(e)).error&&"error"===r?t(n.error):n.on(r,t):"defined"===r&&t(h[i])}function O(t,e){var r=t.requireModules,i=!1;e?e(t):(each(r,function(e){var r=getOwn(d,e);r&&(r.error=t,r.events.error&&(i=!0,r.emit("error",t)))}),i||req.onError(t))}function M(){globalDefQueue.length&&(apsp.apply(m,[m.length,0].concat(globalDefQueue)),globalDefQueue=[])}function P(e){delete d[e],delete l[e]}function R(){var e,i,r=1e3*b.waitSeconds,n=r&&f.startTime+r<(new Date).getTime(),s=[],o=[],a=!1,c=!0;if(!t){if(t=!0,eachProp(l,function(e){var r=e.map,t=r.id;if(e.enabled&&(r.isDefine||o.push(e),!e.error))if(!e.inited&&n)k(t)?a=i=!0:(s.push(t),w(t));else if(!e.inited&&e.fetched&&r.isDefine&&(a=!0,!r.prefix))return c=!1}),n&&s.length)return(e=makeError("timeout","Load timeout for modules: "+s,null,s)).contextName=f.contextName,O(e);c&&each(o,function(e){!function n(s,o,a){var e=s.map.id;s.error?s.emit("error",s.error):(o[e]=!0,each(s.depMaps,function(e,r){var t=e.id,i=getOwn(d,t);!i||s.depMatched[r]||a[t]||(getOwn(o,t)?(s.defineDep(r,h[t]),s.check()):n(i,o,a))}),a[e]=!0)}(e,{},{})}),n&&!i||!a||!isBrowser&&!isWebWorker||u||(u=setTimeout(function(){u=0,R()},50)),t=!1}}function o(e){hasProp(h,e[0])||j(E(e[0],null,!0)).init(e[1],e[2])}function s(e,r,t,i){e.detachEvent&&!isOpera?i&&e.detachEvent(i,r):e.removeEventListener(t,r,!1)}function a(e){var r=e.currentTarget||e.srcElement;return s(r,f.onScriptLoad,"load","onreadystatechange"),s(r,f.onScriptError,"error"),{node:r,id:r&&r.getAttribute("data-requiremodule")}}function A(){var e;for(M();m.length;){if(null===(e=m.shift())[0])return O(makeError("mismatch","Mismatched anonymous define() module: "+e[e.length-1]));o(e)}}return p={require:function(e){return e.require?e.require:e.require=f.makeRequire(e.map)},exports:function(e){if(e.usingExports=!0,e.map.isDefine)return e.exports?h[e.map.id]=e.exports:e.exports=h[e.map.id]={}},module:function(e){return e.module?e.module:e.module={id:e.map.id,uri:e.map.url,config:function(){return getOwn(b.config,e.map.id)||{}},exports:e.exports||(e.exports={})}}},(e=function(e){this.events=getOwn(i,e.id)||{},this.map=e,this.shim=getOwn(b.shim,e.id),this.depExports=[],this.depMaps=[],this.depMatched=[],this.pluginMaps={},this.depCount=0}).prototype={init:function(e,r,t,i){i=i||{},this.inited||(this.factory=r,t?this.on("error",t):this.events.error&&(t=bind(this,function(e){this.emit("error",e)})),this.depMaps=e&&e.slice(0),this.errback=t,this.inited=!0,this.ignore=i.ignore,i.enabled||this.enabled?this.enable():this.check())},defineDep:function(e,r){this.depMatched[e]||(this.depMatched[e]=!0,--this.depCount,this.depExports[e]=r)},fetch:function(){if(!this.fetched){this.fetched=!0,f.startTime=(new Date).getTime();var e=this.map;if(!this.shim)return e.prefix?this.callPlugin():this.load();f.makeRequire(this.map,{enableBuildCallback:!0})(this.shim.deps||[],bind(this,function(){return e.prefix?this.callPlugin():this.load()}))}},load:function(){var e=this.map.url;n[e]||(n[e]=!0,f.load(this.map.id,e))},check:function(){if(this.enabled&&!this.enabling){var r,e,t=this.map.id,i=this.depExports,n=this.exports,s=this.factory;if(this.inited){if(this.error)this.emit("error",this.error);else if(!this.defining){if(this.defining=!0,this.depCount<1&&!this.defined){if(isFunction(s)){if(this.events.error&&this.map.isDefine||req.onError!==defaultOnError)try{n=f.execCb(t,s,i,n)}catch(e){r=e}else n=f.execCb(t,s,i,n);if(this.map.isDefine&&void 0===n&&((e=this.module)?n=e.exports:this.usingExports&&(n=this.exports)),r)return r.requireMap=this.map,r.requireModules=this.map.isDefine?[this.map.id]:null,r.requireType=this.map.isDefine?"define":"require",O(this.error=r)}else n=s;this.exports=n,this.map.isDefine&&!this.ignore&&(h[t]=n,req.onResourceLoad&&req.onResourceLoad(f,this.map,this.depMaps)),P(t),this.defined=!0}this.defining=!1,this.defined&&!this.defineEmitted&&(this.defineEmitted=!0,this.emit("defined",this.exports),this.defineEmitComplete=!0)}}else this.fetch()}},callPlugin:function(){var c=this.map,p=c.id,e=E(c.prefix);this.depMaps.push(e),S(e,"defined",bind(this,function(e){var s,r,t,i=getOwn(g,this.map.id),n=this.map.name,o=this.map.parentMap?this.map.parentMap.name:null,a=f.makeRequire(c.parentMap,{enableBuildCallback:!0});return this.map.unnormalized?(e.normalize&&(n=e.normalize(n,function(e){return q(e,o,!0)})||""),S(r=E(c.prefix+"!"+n,this.map.parentMap),"defined",bind(this,function(e){this.init([],function(){return e},null,{enabled:!0,ignore:!0})})),void((t=getOwn(d,r.id))&&(this.depMaps.push(r),this.events.error&&t.on("error",bind(this,function(e){this.emit("error",e)})),t.enable()))):i?(this.map.url=f.nameToUrl(i),void this.load()):((s=bind(this,function(e){this.init([],function(){return e},null,{enabled:!0})})).error=bind(this,function(e){this.inited=!0,(this.error=e).requireModules=[p],eachProp(d,function(e){0===e.map.id.indexOf(p+"_unnormalized")&&P(e.map.id)}),O(e)}),s.fromText=bind(this,function(e,r){var t=c.name,i=E(t),n=useInteractive;r&&(e=r),n&&(useInteractive=!1),j(i),hasProp(b.config,p)&&(b.config[t]=b.config[p]);try{req.exec(e)}catch(e){return O(makeError("fromtexteval","fromText eval for "+p+" failed: "+e,e,[p]))}n&&(useInteractive=!0),this.depMaps.push(i),f.completeLoad(t),a([t],s)}),void e.load(c.name,a,s,b))})),f.enable(e,this),this.pluginMaps[e.id]=e},enable:function(){(l[this.map.id]=this).enabled=!0,this.enabling=!0,each(this.depMaps,bind(this,function(e,r){var t,i,n;if("string"==typeof e){if(e=E(e,this.map.isDefine?this.map:this.map.parentMap,!1,!this.skipMap),this.depMaps[r]=e,n=getOwn(p,e.id))return void(this.depExports[r]=n(this));this.depCount+=1,S(e,"defined",bind(this,function(e){this.defineDep(r,e),this.check()})),this.errback&&S(e,"error",bind(this,this.errback))}t=e.id,i=d[t],hasProp(p,t)||!i||i.enabled||f.enable(e,this)})),eachProp(this.pluginMaps,bind(this,function(e){var r=getOwn(d,e.id);r&&!r.enabled&&f.enable(e,this)})),this.enabling=!1,this.check()},on:function(e,r){var t=this.events[e];(t=t||(this.events[e]=[])).push(r)},emit:function(e,r){each(this.events[e],function(e){e(r)}),"error"===e&&delete this.events[e]}},(f={config:b,contextName:c,registry:d,defined:h,urlFetched:n,defQueue:m,Module:e,makeModuleMap:E,nextTick:req.nextTick,onError:O,configure:function(e){e.baseUrl&&"/"!==e.baseUrl.charAt(e.baseUrl.length-1)&&(e.baseUrl+="/");var t=b.shim,i={paths:!0,bundles:!0,config:!0,map:!0};eachProp(e,function(e,r){i[r]?(b[r]||(b[r]={}),mixin(b[r],e,!0,!0)):b[r]=e}),e.bundles&&eachProp(e.bundles,function(e,r){each(e,function(e){e!==r&&(g[e]=r)})}),e.shim&&(eachProp(e.shim,function(e,r){isArray(e)&&(e={deps:e}),!e.exports&&!e.init||e.exportsFn||(e.exportsFn=f.makeShimExports(e)),t[r]=e}),b.shim=t),e.packages&&each(e.packages,function(e){var r;r=(e="string"==typeof e?{name:e}:e).name,e.location&&(b.paths[r]=e.location),b.pkgs[r]=e.name+"/"+(e.main||"main").replace(currDirRegExp,"").replace(jsSuffixRegExp,"")}),eachProp(d,function(e,r){e.inited||e.map.unnormalized||(e.map=E(r))}),(e.deps||e.callback)&&f.require(e.deps||[],e.callback)},makeShimExports:function(r){return function(){var e;return r.init&&(e=r.init.apply(global,arguments)),e||r.exports&&getGlobal(r.exports)}},makeRequire:function(s,o){function a(e,r,t){var i,n;return o.enableBuildCallback&&r&&isFunction(r)&&(r.__requireJsBuild=!0),"string"==typeof e?isFunction(r)?O(makeError("requireargs","Invalid require call"),t):s&&hasProp(p,e)?p[e](d[s.id]):req.get?req.get(f,e,s,a):(i=E(e,s,!1,!0).id,hasProp(h,i)?h[i]:O(makeError("notloaded",'Module name "'+i+'" has not been loaded yet for context: '+c+(s?"":". Use require([])")))):(A(),f.nextTick(function(){A(),(n=j(E(null,s))).skipMap=o.skipMap,n.init(e,r,t,{enabled:!0}),R()}),a)}return o=o||{},mixin(a,{isBrowser:isBrowser,toUrl:function(e){var r,t=e.lastIndexOf("."),i=e.split("/")[0];return-1!==t&&(!("."===i||".."===i)||1<t)&&(r=e.substring(t,e.length),e=e.substring(0,t)),f.nameToUrl(q(e,s&&s.id,!0),r,!0)},defined:function(e){return hasProp(h,E(e,s,!1,!0).id)},specified:function(e){return e=E(e,s,!1,!0).id,hasProp(h,e)||hasProp(d,e)}}),s||(a.undef=function(t){M();var e=E(t,s,!0),r=getOwn(d,t);w(t),delete h[t],delete n[e.url],delete i[t],eachReverse(m,function(e,r){e[0]===t&&m.splice(r,1)}),r&&(r.events.defined&&(i[t]=r.events),P(t))}),a},enable:function(e){getOwn(d,e.id)&&j(e).enable()},completeLoad:function(e){var r,t,i,n=getOwn(b.shim,e)||{},s=n.exports;for(M();m.length;){if(null===(t=m.shift())[0]){if(t[0]=e,r)break;r=!0}else t[0]===e&&(r=!0);o(t)}if(i=getOwn(d,e),!r&&!hasProp(h,e)&&i&&!i.inited){if(!(!b.enforceDefine||s&&getGlobal(s)))return k(e)?void 0:O(makeError("nodefine","No define call for "+e,null,[e]));o([e,n.deps||[],n.exportsFn])}R()},nameToUrl:function(e,r,t){var i,n,s,o,a,c,p=getOwn(b.pkgs,e);if(p&&(e=p),c=getOwn(g,e))return f.nameToUrl(c,r,t);if(req.jsExtRegExp.test(e))o=e+(r||"");else{for(i=b.paths,s=(n=e.split("/")).length;0<s;--s)if(a=getOwn(i,n.slice(0,s).join("/"))){isArray(a)&&(a=a[0]),n.splice(0,s,a);break}o=n.join("/"),o=("/"===(o+=r||(/^data\:|\?/.test(o)||t?"":".js")).charAt(0)||o.match(/^[\w\+\.\-]+:/)?"":b.baseUrl)+o}return b.urlArgs?o+((-1===o.indexOf("?")?"?":"&")+b.urlArgs):o},load:function(e,r){req.load(f,e,r)},execCb:function(e,r,t,i){return r.apply(i,t)},onScriptLoad:function(e){if("load"===e.type||readyRegExp.test((e.currentTarget||e.srcElement).readyState)){interactiveScript=null;var r=a(e);f.completeLoad(r.id)}},onScriptError:function(e){var r=a(e);if(!k(r.id))return O(makeError("scripterror","Script error for: "+r.id,e,[r.id]))}}).require=f.makeRequire(),f}function getInteractiveScript(){return interactiveScript&&"interactive"===interactiveScript.readyState||eachReverse(scripts(),function(e){if("interactive"===e.readyState)return interactiveScript=e}),interactiveScript}}(this),require.config({baseUrl:"resource/js/app",urlArgs:"v="+(new Date).getHours(),paths:{map:"https://api.map.baidu.com/getscript?v=2.0&ak=F51571495f717ff1194de02366bb8da9&services=&t=20140530104353",css:"../../../../web/resource/js/lib/css.min",angular:"../../../../web/resource/js/lib/angular.min",underscore:"../../../../web/resource/js/lib/underscore.min",moment:"../../../../web/resource/js/lib/moment",bootstrap:"../../../../web/resource/js/lib/bootstrap.min",hammer:"../lib/hammer.min",webuploader:"../../../../web/resource/components/webuploader/webuploader.min",jquery:"../../../../web/resource/js/lib/jquery-1.11.1.min","jquery.jplayer":"../../../../web/resource/components/jplayer/jquery.jplayer.min","jquery.qrcode":"../../../../web/resource/js/lib/jquery.qrcode.min","mui.datepicker":"../../components/datepicker/mui.picker.all","mui.districtpicker":"../../components/districtpicker/mui.city.data-3",daterangepicker:"../../components/daterangepicker/daterangepicker",datetimepicker:"../../components/datetimepicker/bootstrap-datetimepicker.min","mui.pullrefresh":"../../components/pullrefresh/mui.pullToRefresh.material",previewer:"../../components/previewer/mui.previewimage",cropper:"../../components/cropper/cropper.min",swiper:"../../components/swiper/swiper.min",clockpicker:"../../components/clockpicker/clockpicker.min"},shim:{bootstrap:{exports:"$",deps:["jquery"]},angular:{exports:"angular",deps:["jquery"]},hammer:{exports:"hammer"},daterangepicker:{exports:"$",deps:["bootstrap","moment","css!../../components/daterangepicker/daterangepicker.css"]},datetimepicker:{exports:"$",deps:["bootstrap","css!../../components/datetimepicker/bootstrap-datetimepicker.min.css"]},map:{exports:"BMap"},webuploader:{deps:["jquery","css!../../../../web/resource/components/webuploader/webuploader.css","css!../../../../web/resource/components/webuploader/style.css"]},swiper:{deps:["jquery","css!../../components/swiper/swiper.min.css"]},"jquery.jplayer":{exports:"$",deps:["jquery"]},"jquery.qrcode":{exports:"$",deps:["jquery"]},"mui.datepicker":{deps:["mui","css!../../components/datepicker/mui.picker.all.css"],exports:"mui.DtPicker"},"mui.districtpicker":{deps:["mui","mui.datepicker"],exports:"cityData3"},"mui.pullrefresh":{deps:["./resource/components/pullrefresh/mui.pullToRefresh.js"],exports:"mui"},previewer:{deps:["./resource/components/previewer/mui.zoom.js"],exports:"mui"},cropper:{deps:["css!../../components/cropper/cropper.min.css"]},clockpicker:{deps:["css!../../components/clockpicker/clockpicker.min.css"]}}});