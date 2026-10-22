/* Sera v.1 — Paperplane case: the foldable phone (Duo) that opens with the scroll.
   Ported from the Paperplane landing: one angle drives the hinge, the shading and the hands.
   CSS 3D only. Reduced motion shows the phone open. */
( function () {
	'use strict';

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

	document.querySelectorAll( '[data-paperplane-duo]' ).forEach( function ( el ) {
		if ( el.duo ) {
			return;
		}
		var d = new window.PaperplaneDuo( el );
		// The caption bar under the phone follows the opening.
		var bar = el.querySelector( '.duo-cap' );
		if ( bar ) {
			var render = d.render.bind( d );
			d.render = function () {
				render();
				bar.style.setProperty( '--duo-p', Math.max( 0, ( d.current - d.startOpening ) / ( 1 - d.startOpening ) ).toFixed( 3 ) );
			};
			d.render();
		}
	} );
} )();
