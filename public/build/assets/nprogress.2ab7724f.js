import{c as w}from"./_commonjsHelpers.b8add541.js";function N(m,y){for(var t=0;t<y.length;t++){const s=y[t];if(typeof s!="string"&&!Array.isArray(s)){for(const f in s)if(f!=="default"&&!(f in m)){const l=Object.getOwnPropertyDescriptor(s,f);l&&Object.defineProperty(m,f,l.get?l:{enumerable:!0,get:()=>s[f]})}}}return Object.freeze(Object.defineProperty(m,Symbol.toStringTag,{value:"Module"}))}var S={exports:{}};/* NProgress, (c) 2013, 2014 Rico Sta. Cruz - http://ricostacruz.com/nprogress
 * @license MIT */(function(m,y){(function(t,s){m.exports=s()})(w,function(){var t={};t.version="0.2.0";var s=t.settings={minimum:.08,easing:"ease",positionUsing:"",speed:200,trickle:!0,trickleRate:.02,trickleSpeed:800,showSpinner:!0,barSelector:'[role="bar"]',spinnerSelector:'[role="spinner"]',parent:"body",template:'<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'};t.configure=function(e){var r,n;for(r in e)n=e[r],n!==void 0&&e.hasOwnProperty(r)&&(s[r]=n);return this},t.status=null,t.set=function(e){var r=t.isStarted();e=f(e,s.minimum,1),t.status=e===1?null:e;var n=t.render(!r),o=n.querySelector(s.barSelector),a=s.speed,d=s.easing;return n.offsetWidth,T(function(i){s.positionUsing===""&&(s.positionUsing=t.getPositioningCSS()),v(o,O(e,a,d)),e===1?(v(n,{transition:"none",opacity:1}),n.offsetWidth,setTimeout(function(){v(n,{transition:"all "+a+"ms linear",opacity:0}),setTimeout(function(){t.remove(),i()},a)},a)):setTimeout(i,a)}),this},t.isStarted=function(){return typeof t.status=="number"},t.start=function(){t.status||t.set(0);var e=function(){setTimeout(function(){!t.status||(t.trickle(),e())},s.trickleSpeed)};return s.trickle&&e(),this},t.done=function(e){return!e&&!t.status?this:t.inc(.3+.5*Math.random()).set(1)},t.inc=function(e){var r=t.status;return r?(typeof e!="number"&&(e=(1-r)*f(Math.random()*r,.1,.95)),r=f(r+e,0,.994),t.set(r)):t.start()},t.trickle=function(){return t.inc(Math.random()*s.trickleRate)},function(){var e=0,r=0;t.promise=function(n){return!n||n.state()==="resolved"?this:(r===0&&t.start(),e++,r++,n.always(function(){r--,r===0?(e=0,t.done()):t.set((e-r)/e)}),this)}}(),t.render=function(e){if(t.isRendered())return document.getElementById("nprogress");P(document.documentElement,"nprogress-busy");var r=document.createElement("div");r.id="nprogress",r.innerHTML=s.template;var n=r.querySelector(s.barSelector),o=e?"-100":l(t.status||0),a=document.querySelector(s.parent),d;return v(n,{transition:"all 0 linear",transform:"translate3d("+o+"%,0,0)"}),s.showSpinner||(d=r.querySelector(s.spinnerSelector),d&&C(d)),a!=document.body&&P(a,"nprogress-custom-parent"),a.appendChild(r),r},t.remove=function(){k(document.documentElement,"nprogress-busy"),k(document.querySelector(s.parent),"nprogress-custom-parent");var e=document.getElementById("nprogress");e&&C(e)},t.isRendered=function(){return!!document.getElementById("nprogress")},t.getPositioningCSS=function(){var e=document.body.style,r="WebkitTransform"in e?"Webkit":"MozTransform"in e?"Moz":"msTransform"in e?"ms":"OTransform"in e?"O":"";return r+"Perspective"in e?"translate3d":r+"Transform"in e?"translate":"margin"};function f(e,r,n){return e<r?r:e>n?n:e}function l(e){return(-1+e)*100}function O(e,r,n){var o;return s.positionUsing==="translate3d"?o={transform:"translate3d("+l(e)+"%,0,0)"}:s.positionUsing==="translate"?o={transform:"translate("+l(e)+"%,0)"}:o={"margin-left":l(e)+"%"},o.transition="all "+r+"ms "+n,o}var T=function(){var e=[];function r(){var n=e.shift();n&&n(r)}return function(n){e.push(n),e.length==1&&r()}}(),v=function(){var e=["Webkit","O","Moz","ms"],r={};function n(i){return i.replace(/^-ms-/,"ms-").replace(/-([\da-z])/gi,function(u,c){return c.toUpperCase()})}function o(i){var u=document.body.style;if(i in u)return i;for(var c=e.length,g=i.charAt(0).toUpperCase()+i.slice(1),p;c--;)if(p=e[c]+g,p in u)return p;return i}function a(i){return i=n(i),r[i]||(r[i]=o(i))}function d(i,u,c){u=a(u),i.style[u]=c}return function(i,u){var c=arguments,g,p;if(c.length==2)for(g in u)p=u[g],p!==void 0&&u.hasOwnProperty(g)&&d(i,g,p);else d(i,c[1],c[2])}}();function h(e,r){var n=typeof e=="string"?e:b(e);return n.indexOf(" "+r+" ")>=0}function P(e,r){var n=b(e),o=n+r;h(n,r)||(e.className=o.substring(1))}function k(e,r){var n=b(e),o;!h(e,r)||(o=n.replace(" "+r+" "," "),e.className=o.substring(1,o.length-1))}function b(e){return(" "+(e.className||"")+" ").replace(/\s+/gi," ")}function C(e){e&&e.parentNode&&e.parentNode.removeChild(e)}return t})})(S);const x=S.exports,E=N({__proto__:null,default:x},[S.exports]);export{E as n};
