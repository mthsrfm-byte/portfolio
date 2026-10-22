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

/* ---------------------------------------------------------------- the studio tour */
$$('[data-pp-tour]').forEach(el=>{
 const scrs=[...el.querySelectorAll('.pp-tour-scr')],txt=[...el.querySelectorAll('.pp-tour-t')],phs=[...el.querySelectorAll('.pp-tour-ph')],segs=[...el.querySelectorAll('.pp-tour-segs i')],acts=[...el.querySelectorAll('.pp-tour-acts span')];
 const url=el.querySelector('.pp-tour-url b'),call=el.querySelector('.pp-tour-call'),callT=call.querySelector('span'),screen=el.querySelector('.pp-tour-screen'),N=scrs.length;
 const D=scrs.map((s,i)=>({f:s.dataset.f.split(',').map(Number),z:+s.dataset.z,url:s.dataset.url,call:s.dataset.call,cam:s.querySelector('.pp-tour-cam'),act:+segs[i].dataset.act}));
 let cur=-1,raf=0;
 function frame(){raf=0;
  const r=el.getBoundingClientRect();if(r.bottom<-200||r.top>innerHeight+200)return;
  const p=clamp(-r.top/Math.max(1,el.offsetHeight-innerHeight)),x=p*N*.999,k=Math.min(N-1,Math.floor(x)),t=x-k;
  const W=screen.offsetWidth,H=screen.offsetHeight,base=W/1280;
  if(k!==cur){cur=k;scrs.forEach((s,i)=>s.classList.toggle('is-on',i===k));txt.forEach((s,i)=>s.classList.toggle('is-on',i===k));phs.forEach((s,i)=>s.classList.toggle('is-on',i===k));
   url.textContent=D[k].url;callT.textContent=D[k].call;acts.forEach((a,i)=>a.classList.toggle('is-on',i===D[k].act));
   D.forEach((d,i)=>{if(i!==k)d.cam.style.transform=`scale(${base})`})}
  segs.forEach((s,i)=>s.style.setProperty('--f',i<k?1:i>k?0:t.toFixed(3)));
  const d=D[k],z=REDUCE?1:1+(d.z-1)*eio(seg(t,.1,.45))*(1-eio(seg(t,.88,1))),s=base*z;
  const tx=clamp(W/2-d.f[0]*s,W-1280*s,0),ty=clamp(H/2-d.f[1]*s,H-800*s,0);
  d.cam.style.transform=`translate(${tx.toFixed(1)}px,${ty.toFixed(1)}px) scale(${s.toFixed(4)})`;
  call.classList.toggle('is-off',!REDUCE&&!(t>.28&&t<.92));
 }
 const req=()=>{if(!raf)raf=requestAnimationFrame(frame)};
 addEventListener('scroll',req,{passive:true});addEventListener('resize',()=>{cur=-1;req()});frame();
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
