/* Sera v.1 — Paperplane case: the moving parts.
   Ported from the Paperplane landing where they exist there (the Duo, the lab demos), written for the
   case where they don't (the studio tour, the advanced mode, the tabs, styles, router and reels).
   Everything settles into a still, complete layout under reduced motion. */
( function () {
'use strict';
const $=s=>document.querySelector(s),$$=s=>[...document.querySelectorAll(s)];
const REDUCE=matchMedia('(prefers-reduced-motion: reduce)').matches;
const clamp=(v,a=0,b=1)=>Math.min(b,Math.max(a,v)),seg=(p,a,b)=>clamp((p-a)/(b-a)),eio=t=>t<.5?4*t*t*t:1-Math.pow(-2*t+2,3)/2;
/* runs fn every ms while el is on screen */
function whileVisible(el,ms,fn){let id=0;new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting&&!id){fn();id=setInterval(fn,ms)}else if(!e.isIntersecting&&id){clearInterval(id);id=0}}),{threshold:.25}).observe(el)}

/* ---------------------------------------------------------------- clips: load and play only while on screen */
const vio=new IntersectionObserver(es=>es.forEach(e=>{const v=e.target;if(e.isIntersecting){if(!v.src&&v.dataset.src){v.src=v.dataset.src}if(!REDUCE){const p=v.play();p&&p.catch(()=>{})}}else if(!v.paused)v.pause()}),{rootMargin:'120px'});
$$('[data-pp-video]').forEach(v=>vio.observe(v));
$$('.pp-open').forEach(o=>{const v=o.querySelector('video'),bar=o.querySelector('.pp-open-prog');v&&bar&&v.addEventListener('timeupdate',()=>bar.style.setProperty('--p',(v.currentTime/(v.duration||1)).toFixed(4)))});

/* ---------------------------------------------------------------- problem: the eight tabs, then one */
$$('[data-pp-tabs]').forEach(el=>{
 const tabs=[...el.querySelectorAll('.pp-tab:not(.is-pp)')],ps=[...el.querySelectorAll('.pp-tabs-p')];let k=0;
 if(REDUCE){el.classList.add('is-one');return}
 const show=i=>{tabs.forEach((t,j)=>t.classList.toggle('is-on',j===i));ps.forEach((p,j)=>p.classList.toggle('is-on',j===i))};
 whileVisible(el,1900,()=>{if(k<tabs.length){el.classList.remove('is-one');show(k)}else if(k===tabs.length){el.classList.add('is-one')}k=(k+1)%(tabs.length+3)});
});

/* ---------------------------------------------------------------- the studio tour (the landing's camera: focus, vignette, lift, callout) */
$$('[data-pp-tour]').forEach(el=>{
 const stick=el.querySelector('.pp-tour-sticky'),win=el.querySelector('.pp-tour-win'),screen=el.querySelector('.pp-tour-screen'),stage=el.querySelector('.pp-tour-stage');
 const scrs=[...el.querySelectorAll('.pp-tour-scr')],txt=[...el.querySelectorAll('.pp-tour-t')],segs=[...el.querySelectorAll('.pp-tour-segs i')],acts=[...el.querySelectorAll('.pp-tour-acts span')];
 const url=el.querySelector('.pp-tour-url b'),call=el.querySelector('.pp-tour-call'),callT=call.querySelector('b'),spot=el.querySelector('.pp-tour-spot'),pop=el.querySelector('.pp-tour-pop'),N=scrs.length;
 const lerp=(a,b,t)=>a+(b-a)*t,eo=t=>1-Math.pow(1-t,3);
 let mode='',fx={},popI='',popCam=null,lastI=-1,sideUp=true,raf=0;
 const camEl=(k,m)=>scrs[k].querySelector(m==='m'?'.pp-tour-m':'.pp-tour-d');
 const rel=(e,stop)=>{let x=0,y=0,n=e;while(n&&n!==stop){x+=n.offsetLeft;y+=n.offsetTop;n=n.offsetParent}return [x,y,e.offsetWidth,e.offsetHeight]};
 function focus(k,m){const key=k+m;if(!fx[key]){const cam=camEl(k,m),e=cam.querySelector(m==='m'?'.pp-fxm':'.pp-fx');let r=e?rel(e,cam):[m==='m'?20:200,m==='m'?160:160,m==='m'?350:800,m==='m'?300:420];
   if(e&&m==='m'){/* the phone screen sits in .screen: offsets already relative to the canvas */}
   const rad=e?parseFloat(getComputedStyle(e).borderTopLeftRadius)||0:10;fx[key]=[...r,rad]}return fx[key]}
 function layout(){
  const m=innerWidth<=640?'m':'d';if(m!==mode){mode=m;el.dataset.mode=m;fx={};popI='';lastI=-1}
  const CW=m==='m'?393:1280,CH=m==='m'?852:800,AR=CW/CH,bar=m==='m'?0:34,bez=m==='m'?18:0;
  const sR=stage.getBoundingClientRect(),avH=Math.max(260,innerHeight-sR.top+stick.getBoundingClientRect().top-(m==='m'?24:40)-(innerWidth<=1100&&m!=='m'?0:0));
  const maxW=Math.min(stage.clientWidth,(avH-bar-bez)*AR+bez);win.style.width=maxW+'px';
  return {m,CW,CH,vw:maxW-bez,vh:(maxW-bez)/AR};
 }
 function frame(){raf=0;
  const r=el.getBoundingClientRect();if(r.bottom<-100||r.top>innerHeight+100)return;
  const L=layout(),{m,CW,CH,vw,vh}=L,s0=vw/CW;
  const p=clamp(-r.top/Math.max(1,el.offsetHeight-innerHeight)),f=p*N,i=Math.min(N-1,Math.floor(f)),lp=f-i;
  const zt=k=>{if(REDUCE)return 0;const z=k===i?lp:0;return eio(seg(z,.14,.4))-(k===N-1?0:eio(seg(z,.64,.84)))};
  const camOf=(k,t)=>{const [x,y,w,h]=focus(k,m),Z=m==='m'?1.45:+scrs[k].dataset.z;
   let s1=m==='m'?Math.min(s0*Z,vw*1.04/w,vh*.8/h):Math.min(s0*Z,vw*.92/w,vh*.88/h);s1=Math.max(s1,s0);
   const pos=sc=>[clamp(vw/2-(x+w/2)*sc,vw-CW*sc,0),clamp(vh/2-(y+h/2)*sc,vh-CH*sc,0)],[tx1,ty1]=pos(s1);
   return {s:lerp(s0,s1,t),tx:lerp(0,tx1,t),ty:lerp(0,ty1,t)}};
  scrs.forEach((sc,k)=>{let o=0,ty=0,z=1;
   if(k===i){const tr=k===N-1?0:eio(seg(lp,.86,1));o=1-tr;ty=-tr*3;z=1-tr*.03}else if(k===i+1){const tr=eio(seg(lp,.86,1));o=tr;ty=(1-tr)*5}
   sc.style.opacity=o;sc.style.visibility=o>0?'visible':'hidden';sc.style.transform=`translate3d(0,${ty}%,0) scale(${z})`;
   if(o>0){const c=camOf(k,k===i?zt(k):0);camEl(k,m).style.transform=`translate3d(${c.tx}px,${c.ty}px,0) scale(${c.s})`}});
  const t=zt(i),c=camOf(i,t),[x,y,w,h,rad]=focus(i,m),pad=m==='m'?8:10;
  const X=x*c.s+c.tx-pad,Y=y*c.s+c.ty-pad,Wd=w*c.s+pad*2,Hd=h*c.s+pad*2;
  const lift=REDUCE?0:eo(seg(lp,.28,.44))*(1-(i===N-1?0:eo(seg(lp,.6,.72))));
  if(popI!==i+m){popI=i+m;pop.innerHTML='';const cl=camEl(i,m).cloneNode(true);cl.querySelectorAll('video').forEach(v=>{v.removeAttribute('data-pp-video');v.muted=true;v.playsInline=true});cl.classList.add('is-pop');pop.appendChild(cl);popCam=cl;cl.querySelectorAll('video').forEach(v=>{const o=camEl(i,m).querySelector('video');if(o&&o.src){v.src=o.src;v.play&&v.play().catch(()=>{})}})}
  const grow=Math.max(0,Math.min(m==='m'?.08:.05,(vw/Wd-1)*.5)),cx=m==='m'?0:lift*(vw/2-(X+Wd/2)),cy=-lift*(m==='m'?8:14);
  pop.style.left=X+'px';pop.style.top=Y+'px';pop.style.width=Wd+'px';pop.style.height=Hd+'px';pop.style.borderRadius=Math.max(rad*c.s+pad*.6,8)+'px';
  popCam.style.transform=`translate3d(${c.tx-X}px,${c.ty-Y}px,0) scale(${c.s})`;pop.style.opacity=lift>.01?1:0;pop.style.transform=`translate3d(${cx}px,${cy}px,0) scale(${1+lift*grow})`;
  spot.style.opacity=REDUCE?0:Math.max(t,lift);spot.style.setProperty('--cx',(X+Wd/2+cx)+'px');spot.style.setProperty('--cy',(Y+Hd/2+cy)+'px');spot.style.setProperty('--rx',(Math.hypot(Wd,Hd)*.56*(1+lift*grow))+'px');
  const show=REDUCE?1:eo(seg(lp,.3,.42))*(1-(i===N-1?0:eo(seg(lp,.62,.7))));
  if(i!==lastI){lastI=i;callT.textContent=scrs[i].dataset.call;url.textContent=scrs[i].dataset.url;acts.forEach((a,j)=>a.classList.toggle('is-on',j===+segs[i].dataset.act));
   const c1=camOf(i,1),chh=call.offsetHeight||48;sideUp=(y*c1.s+c1.ty-pad)-chh-18>4}
  const cw=call.offsetWidth,chh=call.offsetHeight;
  const ly=sideUp?Y-chh-14+cy:Math.min(Y+Hd+12+(-cy),vh-chh-8);
  call.style.left=Math.max(8,Math.min(vw-cw-8,X+Wd/2+cx-cw/2))+'px';call.style.top=ly+'px';call.style.opacity=show;call.style.transform=`translate3d(0,${(1-show)*12}px,0) scale(${.96+show*.04})`;
  txt.forEach((tc,k)=>{let v;if(k===i)v=k===N-1?0:-eio(seg(lp,.86,1));else if(k===i+1)v=1-eio(seg(lp,.86,1));else v=k<i?-1:1;
   tc.style.visibility=Math.abs(v)>=1?'hidden':'visible';tc.querySelectorAll('.pp-ln>*').forEach((l,j)=>{const d=clamp(v*(1+j*.18),-1,1);l.style.transform=`translate3d(0,${d*115}%,0)`})});
  segs.forEach((e,k)=>e.style.setProperty('--f',clamp(f-k).toFixed(3)));
 }
 const req=()=>{if(!raf)raf=requestAnimationFrame(frame)};
 addEventListener('scroll',req,{passive:true});addEventListener('resize',()=>{fx={};popI='';req()});
 if(document.fonts&&document.fonts.ready)document.fonts.ready.then(()=>{fx={};req()});
 setTimeout(()=>{fx={};req()},600);frame();
});

/* ---------------------------------------------------------------- the spell: words light up with the scroll, the images pop in */
$$('[data-pp-spell]').forEach(el=>{
 if(REDUCE)return;
 const out=[];[...el.childNodes].forEach(n=>{if(n.nodeType===3){n.textContent.split(/(\s+)/).forEach(w=>{if(!w)return;if(/^\s+$/.test(w)){out.push(document.createTextNode(w));return}const sp=document.createElement('span');sp.className='w';sp.textContent=w;out.push(sp)})}else out.push(n)});
 el.textContent='';out.forEach(n=>el.appendChild(n));
 const items=[...el.children];let raf=0;
 const f=()=>{raf=0;const r=el.getBoundingClientRect(),p=clamp((innerHeight*.85-r.top)/(r.height+innerHeight*.35)),k=Math.round(p*items.length*1.15);items.forEach((x,j)=>x.classList.toggle('on',j<k))};
 addEventListener('scroll',()=>{if(!raf)raf=requestAnimationFrame(f)},{passive:true});f();
});

/* ---------------------------------------------------------------- styles: the spell changed, the story stayed */
$$('[data-pp-styles]').forEach(el=>{
 const imgs=[...el.querySelectorAll('.pp-sty-frame img')],th=[...el.querySelectorAll('.pp-sty-thumbs span')],li=[...el.querySelectorAll('.pp-sty-list li')],tag=el.querySelector('.pp-sty-tag b');
 const a=el.querySelector('[data-sw=a]'),b=el.querySelector('[data-sw=b]');let k=0,sw=false;
 if(REDUCE)return;
 const swap=()=>{sw=!sw;if(sw){const ra=a.getBoundingClientRect(),rb=b.getBoundingClientRect();a.style.transform=`translate(${rb.left-ra.left}px,${rb.top-ra.top}px)`;b.style.transform=`translate(${ra.left-rb.left}px,${ra.top-rb.top}px)`;a.style.setProperty('--hl',1);b.style.setProperty('--hl',0)}else{a.style.transform=b.style.transform='';a.style.setProperty('--hl',0);b.style.setProperty('--hl',1);setTimeout(()=>b.style.setProperty('--hl',0),900)}};
 whileVisible(el,2600,()=>{k=(k+1)%imgs.length;[imgs,th,li].forEach(g=>g.forEach((x,j)=>x.classList.toggle('is-on',j===k)));tag.textContent=li[k].firstChild.textContent.trim();swap()});
});

/* ---------------------------------------------------------------- under the hood: the request travels */
$$('[data-pp-route]').forEach(el=>{
 const st=[...el.querySelectorAll('.pp-route-flow li')],eng=[...el.querySelectorAll('.pp-route-eng span')],line=el.querySelector('.pp-route-line');let k=0,e=0;
 if(REDUCE){st.forEach(s=>s.classList.add('was'));return}
 whileVisible(el,1700,()=>{if(k===0){e=(e+1)%eng.length;eng.forEach((x,j)=>x.classList.toggle('is-on',j===e));st.forEach(s=>s.classList.remove('was'))}
  st.forEach((s,j)=>{s.classList.toggle('is-on',j===k);s.classList.toggle('was',j<k)});line.style.setProperty('--k',(k/(st.length-1)).toFixed(3));k=(k+1)%(st.length+1);if(k===st.length){}});
});

/* ---------------------------------------------------------------- engines: the model list and the hourly GPU */
$$('[data-pp-cycle]').forEach(el=>{const rows=[...el.children].slice(1);let k=0;if(REDUCE)return;whileVisible(el,1500,()=>{k=(k+1)%rows.length;rows.forEach((r,j)=>r.classList.toggle('is-on',j===k))})});
$$('[data-pp-clock]').forEach(el=>{let s=42*60+17;if(REDUCE)return;whileVisible(el,1000,()=>{s++;const h=String(Math.floor(s/3600)).padStart(2,'0'),m=String(Math.floor(s/60)%60).padStart(2,'0'),x=String(s%60).padStart(2,'0');el.textContent=`${h}:${m}:${x}`})});

/* ---------------------------------------------------------------- lab demos (Origami Assistant, Smart Engine) + advanced mode */
/* laboratório: demos animadas */
(()=>{
 const w=ms=>new Promise(r=>setTimeout(r,ms));
 const fit=()=>$$('.lx-stage').forEach(st=>{const c=st.firstElementChild;c.style.transform=`scale(${st.offsetWidth/c.offsetWidth})`});
 addEventListener('resize',fit);fit();setTimeout(fit,300);
 /* cada demo tem seu relógio: dá para pular para uma etapa clicando nela (avança rápido até lá) */
 function ctl(id){const c={gen:0,target:-1,ff:false};
  c.w=ms=>{const g=c.gen;if(c.ff)return Promise.resolve().then(()=>{if(g!==c.gen)throw 'x'});return new Promise((r,j)=>setTimeout(()=>g!==c.gen?j('x'):r(),ms))};
  c.steps=i=>{[...$(id).children].forEach((s,k)=>{s.classList.toggle('on',k===i);s.classList.toggle('done',k<i)});if(c.ff&&i>=c.target)c.ff=false};
  [...$(id).children].forEach((s,k)=>s.addEventListener('click',()=>{c.target=k;c.ff=k>0;c.gen++}));
  c.loop=(el,fn)=>{let run=false;new IntersectionObserver(es=>es.forEach(async e=>{if(e.isIntersecting&&!run){run=true;while(true){try{await fn();await c.w(1200)}catch(_){}while(!vis(el))await w(500)}}}),{threshold:.35}).observe(el)};
  return c}
 function cursor(cv,cur,T){
   let x=760,y=480;cur.style.transform=`translate(${x}px,${y}px)`;
   const to=async(el,dx=.5,dy=.5,ms=900)=>{const a=cv.getBoundingClientRect(),b=el.getBoundingClientRect(),s=a.width/cv.offsetWidth;
     x=(b.left-a.left+b.width*dx)/s;y=(b.top-a.top+b.height*dy)/s;cur.style.transitionDuration=(T.ff?0:ms)+'ms';cur.style.transform=`translate(${x}px,${y}px)`;await T.w(ms)};
   const click=async()=>{cur.classList.remove('click');void cur.offsetWidth;cur.classList.add('click');await T.w(260)};
   return {to,click};
 }
 const steps=(id,i)=>[...$(id).children].forEach((s,k)=>{s.classList.toggle('on',k===i);s.classList.toggle('done',k<i)});
 const vis=el=>{const r=el.getBoundingClientRect();return r.bottom>0&&r.top<innerHeight};
 const loopWhenVisible=(el,fn)=>{let run=false;new IntersectionObserver(es=>es.forEach(async e=>{if(e.isIntersecting&&!run){run=true;while(true){await fn();await w(1200);while(!vis(el))await w(500)}}}),{threshold:.35}).observe(el)};

 if($('#oriCv')){
 const O=ctl('#oriSteps'),M=ctl('#seSteps');
 /* ORIGAMI */
 const cv=$('#oriCv'),C=cursor(cv,$('#oriCur'),O),chat=$('#oaChat'),inp=$('#oaIn'),body=$('.oa-body'),line=$('#oaLine'),lineT=$('#oaLineT'),list=$('#oaList');
 const TS='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round"><path d="M1.2 7.6 7.6 15.6l2.6-1.1Z"/><path d="M2.2 21.5 7.6 15.6h2.6l5.4 3.4Z"/><path d="M2.2 21.5 15.6 19"/><path d="M10.2 15.6 12.7 13.3l2.9 3.9.7 3.8-2.1-1.4"/><path d="M16.3 21 18.6 13l.9-.6 3.8 3-3.6-.6-3.1 6.2"/><path d="M10.9 14.6 11.1 11 19.9 2.5l-.5 10.2"/><path d="M19.9 2.5 14.5 15"/></svg>';
 const type=async(el,t,sp=34)=>{el.textContent='';for(const ch of t){el.textContent+=ch;await O.w(sp)}};
 /* digitação humana: ritmo irregular, uma pausa para pensar e um erro corrigido */
 const typeH=async(el,t,typo)=>{el.textContent='';let k=0;for(const ch of t){if(typo&&k===typo[0]){for(const x of typo[1]){el.textContent+=x;await O.w(60+Math.random()*60)}await O.w(260);for(let j=0;j<typo[1].length;j++){el.textContent=el.textContent.slice(0,-1);await O.w(55)}}el.textContent+=ch;k++;await O.w(ch===' '?70+Math.random()*90:28+Math.random()*70)}};
 const stream=async(el,t)=>{const ws=t.split(' ');el.textContent='';for(const x of ws){el.textContent+=(el.textContent?' ':'')+x;await O.w(45+Math.random()*60)}};
 const add=(cls,html)=>{const d=document.createElement('div');d.className=cls;d.innerHTML=html;chat.appendChild(d);return d};
 O.loop($('#labOri'),async()=>{
   chat.innerHTML='';body.classList.remove('h');$('#oaTabC').classList.add('on');$('#oaTabH').classList.remove('on');lineT.textContent='Você não devia estar aqui.';line.classList.remove('hl');
   list.querySelectorAll('.new').forEach(e=>e.remove());$('#oaBadge').textContent='3';
   add('oa-m o','Oi, Matheus! Tô de olho na cena 3. O que vamos aprontar hoje?');
   O.steps(0);
   await C.to($('.oa-in'),.4,.5);await C.click();
   $('.oa-in').classList.add('typing');await O.w(350);
   await typeH(inp,'Deixa a fala do Dante mais ameaçadora',[22,'mia']);await O.w(500);$('.oa-in').classList.remove('typing');
   await C.to($('.oa-send'));await C.click();
   add('oa-m u',inp.textContent);inp.textContent='';
   const th=add('oa-think',TS+'<span class="tt">Origami lendo a cena 3…</span><div class="oa-sk"><i></i><i></i><i style="width:60%"></i></div>');
   await O.w(1100);th.querySelector('.tt').textContent='Reescrevendo a fala do Dante…';await O.w(1300);th.remove();
   O.steps(1);
   const m=add('oa-m o','<span class="st"></span><div class="oa-rest"><div class="oa-diff"><div class="del">Você não devia estar aqui.</div><div class="add">Ninguém embarca neste trem por acaso, Lia.</div></div><div class="oa-acts"><span class="oa-btn" id="oaApply">Aplicar</span><span class="oa-btn gh">Outra versão</span></div></div>');
   m.querySelector('.oa-rest').style.opacity=0;await stream(m.querySelector('.st'),'Pronto. Mexi só na fala, o resto da cena continua igual:');await O.w(200);m.querySelector('.oa-rest').style.cssText='opacity:1;transition:opacity .5s';
   await O.w(1300);
   O.steps(2);
   const ap=$('#oaApply');await C.to(ap);await C.click();ap.classList.add('press');await O.w(150);ap.classList.remove('press');
   line.classList.add('hl');await type(lineT,'Ninguém embarca neste trem por acaso, Lia.',26);
   $('#oaToast').classList.add('on');ap.textContent='✓ Aplicado';
   const b=$('#oaBadge');b.textContent='4';b.classList.add('pop');setTimeout(()=>b.classList.remove('pop'),400);
   await O.w(1500);$('#oaToast').classList.remove('on');line.classList.remove('hl');
   O.steps(3);
   await C.to($('#oaTabH'));await C.click();
   $('#oaTabC').classList.remove('on');$('#oaTabH').classList.add('on');body.classList.add('h');
   const e=document.createElement('div');e.className='oa-e new';e.innerHTML='<div><span>Roteiro · Cena 3 · agora</span>Fala do Dante reescrita<div class="undo"><span class="oa-btn gh">Ver antes e depois</span><span class="oa-btn">Desfazer</span></div></div><em>agora</em>';
   await O.w(400);list.prepend(e);await O.w(900);
   await C.to(e,.4,.4);e.classList.add('open');await O.w(1600);
   await C.to($('#oaCh'),.5,.5);$('#oaCh').classList.add('hov');await C.click();$('#oaMenu').classList.add('on');await O.w(1800);
   $('#oaMenu').classList.remove('on');$('#oaCh').classList.remove('hov');await O.w(400);
   O.steps(4);
 });

 /* SMART ENGINE */
 const sv=$('#seCv'),K=cursor(sv,$('#seCur'),M),sm=$('.sm'),rows=$$('#smRows .sm-r'),D=$('#smD'),par=$('#smPar');
 const wave=$('#smWave');wave.innerHTML=Array.from({length:46},(_,i)=>`<b class="${i>33?'g':''}" style="height:${18+Math.abs(Math.sin(i*1.3)*70+Math.sin(i*.4)*12)}%"></b>`).join('');
 [...wave.children].forEach((b,i)=>b.style.transitionDelay=(i*12)+'ms');
 M.loop($('#labSmart'),async()=>{
   sm.classList.remove('on');rows.forEach(r=>r.classList.remove('on','sel'));D.removeAttribute('data-s');$('#smCost').classList.remove('on');$('#smC1').style.width='0';$('#smC2').style.width='0';wave.classList.remove('on');$('#smSpr').classList.remove('on');par.className='sm-par';
   M.steps(0);
   await M.w(500);await K.to($('#smTg'),.25,.5);await K.click();sm.classList.add('on');await M.w(500);
   M.steps(1);
   rows.forEach(r=>r.classList.add('shim'));await M.w(2000);rows.forEach(r=>r.classList.remove('shim'));
   for(const r of rows){await M.w(220);r.classList.add('on')}
   await M.w(600);
   M.steps(2);
   await K.to(rows[2],.3,.5);await K.click();rows.forEach(r=>r.classList.remove('sel'));rows[2].classList.add('sel');D.dataset.s='f';
   await M.w(500);wave.classList.add('on');await M.w(900);$('#smSpr').classList.add('on');await M.w(2600);
   M.steps(3);
   await K.to(rows[1],.3,.5);await K.click();rows.forEach(r=>r.classList.remove('sel'));rows[1].classList.add('sel');D.dataset.s='p';
   await M.w(500);par.classList.add('pan');await M.w(5200);
   M.steps(4);
   rows.forEach(r=>r.classList.remove('sel'));
   $('#smCost').classList.add('on');await K.to($('#smCost'),.7,.5);$('#smC1').style.width='100%';await M.w(500);$('#smC2').style.width='24%';await M.w(2600);
   M.steps(5);
 });

 }
 /* MODO AVANÇADO (case): referências → pedido → takes → aprovação, no mesmo cursor das demos */
 if($('#ndCv')){
  const N=ctl('#ndSteps'),nv=$('#ndCv'),Kn=cursor(nv,$('#ndCur'),N),pr=$('#ndPrompt'),full=pr.dataset.full,newB=$('#ndNew'),tks=[...nv.querySelectorAll('.pp-nd-take')],wt=[...nv.querySelectorAll('.w-take')],sum=$('#ndSum'),toast=$('#ndToast');
  const finalState=()=>{nv.dataset.st='3';pr.textContent=full;tks.forEach(t=>t.classList.add('on','done'));wt.forEach(x=>x.classList.add('on'));tks[2].classList.add('is-ok');tks[2].querySelector('.pp-nd-tag').textContent='Aprovado';nv.classList.add('is-final');sum.textContent='3 takes'};
  if(REDUCE){finalState();N.steps(3)}else{
  const typeP=async t=>{pr.textContent='';nv.classList.add('is-typing');for(const ch of t){pr.textContent+=ch;await N.w(12)}nv.classList.remove('is-typing')};
  N.loop($('[data-pp-nodes]'),async()=>{
    nv.removeAttribute('data-st');nv.classList.remove('is-cmp','is-final','is-typing');pr.textContent='';
    tks.forEach(t=>{t.classList.remove('on','done','is-ok');t.querySelector('.pp-nd-tag').textContent='Em revisão'});wt.forEach(x=>x.classList.remove('on'));toast.classList.remove('on');sum.textContent='0 takes';
    N.steps(0);await N.w(400);nv.dataset.st='0';await N.w(1800);
    N.steps(1);await Kn.to(pr,.25,.2);await Kn.click();await typeP(full);await N.w(600);
    N.steps(2);
    for(let i=0;i<3;i++){await Kn.to(newB);await Kn.click();newB.classList.add('press');await N.w(140);newB.classList.remove('press');wt[i].classList.add('on');tks[i].classList.add('on');await N.w(1000);tks[i].classList.add('done');sum.textContent=(i+1)+(i?' takes':' take');await N.w(450)}
    N.steps(3);
    nv.classList.add('is-cmp');await Kn.to(tks[0].querySelector('.pp-nd-btn'));await Kn.click();await N.w(1100);
    const ap=tks[2].querySelector('.is-lime');await Kn.to(ap);await Kn.click();ap.classList.add('press');await N.w(150);ap.classList.remove('press');
    nv.classList.remove('is-cmp');tks[2].classList.add('is-ok');tks[2].querySelector('.pp-nd-tag').textContent='Aprovado';nv.classList.add('is-final');toast.classList.add('on');await N.w(2800);toast.classList.remove('on');
    N.steps(4);
  });}
 }
})();

/* ---------------------------------------------------------------- the Duo (from the landing) + the phones that rise around it */
window.PaperplaneDuo=class PaperplaneDuo{
  constructor(section){
    section.querySelectorAll('[data-duo-hand]').forEach(img=>{img.src=section.dataset.duoHandSrc});
    this.section=section;this.device=section.querySelector('.duo-device');this.rig=section.querySelector('.duo-rig');
    this.left=section.querySelector('.duo-left');this.stage=section.querySelector('.duo-stage');
    
    this.reduce=matchMedia('(prefers-reduced-motion: reduce)').matches;
    this.startOpening=95/180;
    this.current=this.target=this.reduce?1:this.startOpening;this.manual=false;this.frame=0;this.playing=false;this.startTime=0;
    this.tilt={x:0,y:0};this.active=true;
    this.onScroll=()=>{if(this.manual||this.playing||this.reduce)return;const rect=section.getBoundingClientRect();const travel=section.offsetHeight-innerHeight;const progress=Math.max(0,Math.min(1,-rect.top/Math.max(1,travel)));this.target=this.startOpening+(1-this.startOpening)*Math.max(0,Math.min(1,(progress-.08)/.72));this.wake()};
    window.addEventListener('scroll',this.onScroll,{passive:true});
    this.observer=new ResizeObserver(()=>{this.layout();this.onScroll()});this.observer.observe(this.device);
    window.addEventListener('resize',()=>this.layout(),{passive:true});
    this.visibility=new IntersectionObserver(entries=>{this.active=entries[0].isIntersecting;if(this.active)this.wake()},{rootMargin:'100px'});this.visibility.observe(section);
    window.addEventListener('pp-jump',()=>{this.onScroll();this.current=this.target;this.render()});
    section.duo=this;this.layout();this.onScroll();this.wake();
  }
  layout(){
    const w=this.device.clientWidth,h=this.device.clientHeight,b=parseFloat(getComputedStyle(this.device).getPropertyValue('--bezel'));
    const s=(w-2*b)/1024;
    this.device.querySelectorAll('.duo-inner-ui').forEach(el=>{el.style.transform=`scale(${s},${(h-2*b)/980})`;el.style.left=el.closest('.duo-right')?`${-(w/2-b)}px`:'0px'});
    this.device.querySelectorAll('.duo-cover-ui').forEach(el=>{el.style.transform=`scale(${(w/2-14)/390},${(h-14)/780})`});
    this.section.querySelectorAll('.duo-sat-ui').forEach(el=>{const host=el.parentElement;if(host.clientWidth)el.style.transform=`scale(${Math.max(host.clientWidth/390,host.clientHeight/844)})`});
    this.render();
  }
  setOpen(value){this.manual=true;this.target=Math.max(0,Math.min(1,Number(value)||0));this.wake()}
  wake(){if(!this.frame)this.frame=requestAnimationFrame(t=>this.tick(t))}
  tick(t){
    this.frame=0;
    if(this.playing){const p=((t-this.startTime)%10000)/10000;const phase=p<.12?0:p<.6?this.ease((p-.12)/.48):p<.78?1:1-this.ease((p-.78)/.22);this.target=this.startOpening+(1-this.startOpening)*phase}
    this.current+= (this.target-this.current)*(this.reduce?1:.11);
    if(Math.abs(this.current-this.target)<.0003)this.current=this.target;
    this.render();if(this.active&&(this.playing||this.current!==this.target))this.wake();
  }
  ease(t){return t*t*(3-2*t)}
  render(){
    const o=this.current,w=this.device.clientWidth;
    this.device.style.setProperty('--spine',`${2+28*Math.pow(1-o,8)}px`);
    // A slight residual angle preserves the hardware's depth when unfolded.
    const angle=(1-o)*178.2+.8,rad=angle*Math.PI/180;
    this.left.style.transform=`rotateY(${angle}deg)`;
    this.rig.style.transform=`translateX(${-(1-o)*25}%) rotateX(${7-5*o}deg) rotateY(${-14+14*o}deg) rotateZ(${-3+2*o}deg)`;
    const hand=this.device.querySelector('.duo-hand-left');
    const grip=Math.sin(rad);
    hand.style.transform=`translateX(${w*.5*(1-Math.cos(rad))-w*.018*grip}px) translateY(${w*.012*grip}px) translateZ(${13+w*.5*Math.sin(rad)}px) rotateY(${Math.min(angle,70)*.10}deg)`;
    hand.style.opacity=Math.min(1,Math.max(0,(o-.28)/.22));
    this.device.querySelector('.duo-left .duo-shade').style.opacity=(1-o)*.4;
    this.device.querySelectorAll('.duo-crease').forEach(e=>e.style.opacity=.18+(1-o)*.25);
  }
};
$$('[data-paperplane-duo]').forEach(el=>{if(el.duo)return;
 const d=new window.PaperplaneDuo(el),sats=[...el.querySelectorAll('.pp-duo-sat')];
 const rise=()=>{const r=el.getBoundingClientRect(),p=REDUCE?1:clamp(-r.top/Math.max(1,el.offsetHeight-innerHeight));
  sats.forEach(s=>{const k=Math.abs(+getComputedStyle(s).getPropertyValue('--k'));s.style.setProperty('--rise',REDUCE?1:eio(seg(p,.04+k*.1,.36+k*.1)).toFixed(3))})};
 addEventListener('scroll',rise,{passive:true});rise();
});
} )();
