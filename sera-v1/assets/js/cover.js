/* Sera · cover hero (generated from the hero lab). Three.js + GLTFLoader are vendored in assets/js/lib/three. */
import * as THREE from './lib/three/three.module.min.js';
import { GLTFLoader } from './lib/three/addons/loaders/GLTFLoader.js';

/* ---------- the effects ---------- */
const cvRoot = document.getElementById('cover');
if (!cvRoot) { throw new Error('no cover'); }
const CV = { model: cvRoot.dataset.model, say: cvRoot.dataset.say || 'hi!', me: cvRoot.dataset.me || 'Matheus', you: cvRoot.dataset.you || 'You' };
document.documentElement.classList.add('cv-on');
const FX = [
  { id: 'meio-tom',   name: 'Meio-tom',        lens: 0.30, how: 'Impressão de revista em duas tintas. <b>Chegue perto</b>: a lupa revela a foto.' },
  { id: 'curvas',     name: 'Curvas de nível', lens: 0.30, how: 'O rosto como mapa topográfico. <b>Chegue perto</b>: a lupa mostra as curvas finas.' },
  { id: 'particulas', name: 'Partículas',      lens: 0.36, how: 'Só os vértices da malha. <b>Passe o mouse</b> e eles se espalham como poeira.' },
  { id: 'ascii',      name: 'ASCII',           lens: 0.30, how: 'Retrato em caracteres mono. <b>Chegue perto</b>: a lupa dobra a resolução.' },
  { id: 'fatias',     name: 'Fatias',          lens: 0.40, how: 'O busto em lâminas. <b>Passe o mouse</b>: as fatias abrem e deslizam na altura do cursor.' },
  { id: 'show',       name: 'Coreografia',     lens: 0,    how: '' },
  { id: 'show-logo',  name: 'Coreo · Logo',    lens: 0,    how: '' },
  { id: 'pulso',      name: 'Pulso',           lens: 0,    how: 'Uma varredura percorre a malha e mostra a grade por baixo. <b>Passe o mouse ou toque no rosto</b> para disparar.' }
];

const TORSO = ['camiseta', 'base do busto', 'base do pescoço'];
const reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const canvas = cvRoot.querySelector('canvas.bust');
const renderer = new THREE.WebGLRenderer({ canvas, antialias: true, alpha: true });
const dpr = Math.min(window.devicePixelRatio || 1, 2);
renderer.setPixelRatio(dpr);
renderer.outputColorSpace = THREE.SRGBColorSpace;
renderer.setClearColor(0x000000, 0);
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(24, 1, 0.01, 20);
scene.add(new THREE.HemisphereLight(0xfff6ec, 0x8a8478, 1.5));
const dl = new THREE.DirectionalLight(0xffffff, 2.1); dl.position.set(0.8, 1.2, 2); scene.add(dl);
const fill = new THREE.DirectionalLight(0xdfe9e8, 0.7); fill.position.set(-1.4, 0.3, 1); scene.add(fill);
const rig = new THREE.Group(); scene.add(rig);
const pivot = new THREE.Group(); rig.add(pivot);

const col = h => new THREE.Color(h);
const U = {
  uTime: { value: 0 }, uPtr: { value: new THREE.Vector3(-1e4, -1e4, 0) }, uRes: { value: new THREE.Vector2(1, 1) },
  uDpr: { value: dpr }, uTanHalf: { value: Math.tan(THREE.MathUtils.degToRad(12)) }, uOpen: { value: 0 },
  uInk: { value: col(0x111110) }, uPaper: { value: col(0xEEEBE3) }, uStone: { value: col(0xDCD7CA) },
  uTeal: { value: col(0x0B5F63) }, uTealLt: { value: col(0x8CC9C2) },
  uRigWorld: { value: new THREE.Matrix4() }, uHeadC: { value: new THREE.Vector3(0, 0.3, 0) },
  uB: { value: 0 }, uS: { value: 0 }, uG: { value: 0 }, uSpin: { value: 0 }, uInkMix: { value: 0 }, uAlpha: { value: 1 }, uCamD: { value: 1 }, uToH: { value: 0 }, uFromH: { value: 0 }, uLogoH: { value: new THREE.Vector4() }, uDotH: { value: 1.5 }, tMaze: { value: null }, tLogo: { value: null }, uLogo: { value: new THREE.Vector4() }, uMaze: { value: 0 }, uRet: { value: 0 }, uVar: { value: 0 }, uBound: { value: 0.56 }, uDot: { value: 3 }, uLock: { value: -1 }, uSolve: { value: -1 }, uWaveV: { value: 0.11 }, uWaveF: { value: 0.6 }, uMask: { value: Array.from({ length: 16 }, () => new THREE.Vector4()) }, uMaskPad: { value: 28 },
  uHit: { value: Array.from({ length: 8 }, () => new THREE.Vector4(0, 0, 0, -99)) }, uHitK: { value: new Array(8).fill(0) }
};

/* shared GLSL: model-space position (sticks to the face as it turns), albedo, pointer lens */
const VH = `
uniform mat4 uM; uniform vec3 uOff; uniform float uTime; uniform vec3 uPtr; uniform vec2 uRes; uniform float uDpr; uniform float uOpen;
varying vec3 vP; varying vec3 vNv; varying vec2 vUv;
float hash3(vec3 p){ return fract(sin(dot(p, vec3(12.9898, 78.233, 37.719))) * 43758.5453); }
`;
const FH = `
uniform sampler2D uMap; uniform float uHasMap; uniform vec3 uColor; uniform float uCut;
uniform float uTime; uniform vec3 uPtr; uniform vec2 uRes; uniform float uDpr;
uniform vec3 uInk; uniform vec3 uPaper; uniform vec3 uStone; uniform vec3 uTeal; uniform vec3 uTealLt;
varying vec3 vP; varying vec3 vNv; varying vec2 vUv;
vec3 albedo(){ return uHasMap > .5 ? texture2D(uMap, vUv).rgb : uColor; }
void cutout(){ if (uCut > 0. && uHasMap > .5 && texture2D(uMap, vUv).a < uCut) discard; }
float lensAt(vec2 fc, out float ring){
  float d = distance(fc, uPtr.xy), r = uPtr.z, on = step(1., r);
  ring = (1. - smoothstep(0., 1.6 * uDpr, abs(d - r + uDpr))) * on;
  return (1. - smoothstep(r - 1.5 * uDpr, r + 1.5 * uDpr, d)) * on;
}
`;
const VBASE = `void main(){ vec4 lp = uM * vec4(position, 1.); vP = lp.xyz + uOff; vNv = normalize(normalMatrix * normal); vUv = uv; gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.); }`;

/* 2 · Curvas de nível: depth contours painted on the skin, drifting outward from the nose */
const TOPO_F = FH + `
float iso(float h, float w){ float aa = fwidth(h); float d = .5 - abs(fract(h) - .5); return 1. - smoothstep(aa * w * .5, aa * (w * .5 + 1.), d); }
void main(){
  cutout();
  vec3 n = normalize(vNv); if (!gl_FrontFacing) n = -n;
  float lam = clamp(dot(n, normalize(vec3(.35, .55, .75))), 0., 1.);
  float rim = pow(1. - clamp(abs(n.z), 0., 1.), 2.4);
  float h = vP.z * 240. - uTime * .22;
  float k = floor(h + .5); float major = 1. - step(.5, mod(k, 5.));
  float line = iso(h, mix(.9, 2.1, major));
  float ring; float inL = lensAt(gl_FragCoord.xy, ring);
  float fine = iso(h * 2.5, .9) * inL * (1. - line);
  vec3 base = uStone * (.6 + .4 * lam);
  base = mix(base, uPaper * (.86 + .14 * lam), inL);
  base = mix(base, uInk, rim * .32);
  vec3 c = mix(base, uInk, line * (.5 + .45 * major) * (1. - inL * .55));
  c = mix(c, uTeal, fine * .9);
  c = mix(c, uTeal, ring);
  gl_FragColor = vec4(c, 1.);
  #include <colorspace_fragment>
}`;

/* 5 · Fatias: lamellas that open and slide sideways around the pointer's height */
const SLICE_V = VH + `
uniform float uN; varying float vK;
void main(){
  vec4 lp = uM * vec4(position, 1.); vP = lp.xyz + uOff; vNv = normalize(normalMatrix * normal); vUv = uv;
  vec4 mv = modelViewMatrix * vec4(position, 1.);
  vec4 c0 = projectionMatrix * mv;
  float sy = (c0.y / c0.w * .5 + .5) * uRes.y;
  float band = max(uPtr.z, 60. * uDpr) * 1.25;
  float k = exp(-pow((sy - uPtr.y) / band, 2.)) * uOpen;
  float slab = floor(vP.y * uN);
  float off = (sin(slab * .9 + uTime * 1.7) * .011 + sin(slab * .31 - uTime * .8) * .005) * k;
  mv.x += off; mv.z += abs(off) * .5;
  vK = k;
  gl_Position = projectionMatrix * mv;
}`;
const SLICE_F = FH + `
uniform float uN; varying float vK;
void main(){
  cutout();
  float s = fract(vP.y * uN);
  float gap = .14 + .62 * vK;
  if (s < gap) discard;
  vec3 c;
  if (gl_FrontFacing) {
    c = albedo();
    float e = 1. - smoothstep(0., fwidth(vP.y * uN) * 1.6, s - gap);
    c = mix(c, uTealLt, e * (.25 + .75 * vK));
  } else {
    c = uTeal * (.45 + .55 * s);
  }
  gl_FragColor = vec4(c, 1.);
  #include <colorspace_fragment>
}`;

/* 6 · Pulso: one hairline scan front travels over the skin; in its wake the photo drains to grey and a
   measured grid shows through, then settles back. The pointer carries a small lens with the same grid. */
const WAVE_V = VH + `
uniform vec4 uHit[8]; uniform float uHitK[8]; uniform float uWaveV; uniform float uWaveF;
varying vec3 vNm;
void main(){
  vec4 lp = uM * vec4(position, 1.); vP = lp.xyz + uOff; vUv = uv;
  vec3 n = normalize(normalMatrix * normal); vNv = n;
  vNm = normalize(mat3(uM) * normal);
  float bump = 0.;
  for (int i = 0; i < 8; i++) {
    vec4 h = uHit[i]; float age = uTime - h.w;
    if (age < 0. || age > 4.) continue;
    float x = distance(vP, h.xyz) - age * uWaveV;
    bump += exp(-x * x / .00003) * exp(-age * uWaveF) * uHitK[i];
  }
  vec4 mv = modelViewMatrix * vec4(position, 1.);
  mv.xyz += n * bump * .0014;
  gl_Position = projectionMatrix * mv;
}`;
const WAVE_F = FH + `
uniform vec4 uHit[8]; uniform float uHitK[8]; uniform float uWaveV; uniform float uWaveF;
varying vec3 vNm;
float hair(float v, float w){ float aa = fwidth(v); float d = .5 - abs(fract(v) - .5); return 1. - smoothstep(aa * w, aa * (w + 1.), d); }
void main(){
  cutout();
  vec3 base = albedo();
  float g = dot(base, vec3(.2126, .7152, .0722));
  // triplanar millimetre grid in model space, so it stays on the face as it turns
  vec3 q = vP * 95.;
  vec3 wN = pow(abs(normalize(vNm)), vec3(6.)); wN /= (wN.x + wN.y + wN.z);
  float grid = max(hair(q.y, .5), hair(q.z, .5)) * wN.x + max(hair(q.x, .5), hair(q.z, .5)) * wN.y + max(hair(q.x, .5), hair(q.y, .5)) * wN.z;
  float aaD = length(fwidth(vP)) + 1e-5;
  float front = 0., wake = 0., halo = 0.;
  for (int i = 0; i < 8; i++) {
    vec4 h = uHit[i]; float age = uTime - h.w;
    if (age < 0. || age > 4.) continue;
    float x = distance(vP, h.xyz) - age * uWaveV;
    float fade = exp(-age * uWaveF) * uHitK[i];
    front += (1. - smoothstep(aaD * .6, aaD * 1.8, abs(x))) * fade;
    halo += exp(-x * x / .00012) * step(x, 0.) * fade;
    wake += smoothstep(-.11, -.004, x) * (1. - step(0., x)) * fade;
  }
  float ring; float inL = lensAt(gl_FragCoord.xy, ring);
  // four ticks on the lens ring, at 12, 3, 6 and 9 o'clock
  vec2 dv = gl_FragCoord.xy - uPtr.xy; float r = uPtr.z;
  float tick = (1. - smoothstep(uDpr * .6, uDpr * 1.6, min(abs(dv.x), abs(dv.y)))) * step(r - 7. * uDpr, length(dv)) * step(length(dv), r + 7. * uDpr) * step(1., r);
  float reveal = clamp(wake + inL, 0., 1.);
  vec3 cold = mix(vec3(g), vec3(1.), .22);
  vec3 c = mix(base, cold, reveal * .85);
  c = mix(c, vec3(1.), grid * reveal * .42);
  c = mix(c, vec3(1.), clamp(halo, 0., 1.) * .16);
  c = mix(c, vec3(1.), clamp(front, 0., 1.));
  c = mix(c, vec3(1.), clamp(ring * .9 + tick, 0., 1.));
  gl_FragColor = vec4(c, 1.);
  #include <colorspace_fragment>
}`;

/* 3 · Partículas: every vertex as a dot of its own colour; the pointer blows them away */
const PTS_V = VH + `
uniform float uTanHalf; varying float vPush;
void main(){
  vUv = uv;
  vec4 mv = modelViewMatrix * vec4(position, 1.);
  vec4 clip = projectionMatrix * mv;
  vec2 sp = (clip.xy / clip.w * .5 + .5) * uRes;
  vec2 dv = sp - uPtr.xy; float d = length(dv);
  float R = max(uPtr.z, 1.) * 1.35;
  float k = smoothstep(R, 0., d) * step(1., uPtr.z); k *= k;
  float rnd = hash3(position);
  float pxToView = (2. * uTanHalf * -mv.z) / uRes.y;
  vec2 dir = d > .001 ? dv / d : vec2(0., 1.);
  float ang = (rnd - .5) * 1.4;
  dir = mat2(cos(ang), -sin(ang), sin(ang), cos(ang)) * dir;
  mv.xy += dir * k * R * (.12 + rnd * .5) * pxToView;
  mv.z += k * .03 * rnd;
  mv.xyz += vec3(sin(uTime * 1.3 + rnd * 40.), cos(uTime * 1.1 + rnd * 31.), 0.) * .00045;
  gl_Position = projectionMatrix * mv;
  gl_PointSize = uDpr * (1.75 + k * 2.4 * rnd);
  vPush = k;
}`;
const PTS_F = FH + `
varying float vPush;
void main(){
  cutout();
  vec2 q = gl_PointCoord - .5; if (dot(q, q) > .25) discard;
  vec3 c = mix(albedo(), uTealLt, vPush * .65);
  gl_FragColor = vec4(c, 1.);
  #include <colorspace_fragment>
}`;


/* 7 · Coreografia: the mesh bursts into its vertices in every direction, hangs, drifts, and is pulled home */
const SHOW_V = VH + `
uniform mat4 uRigWorld; uniform vec3 uHeadC; uniform float uB; uniform float uS; uniform float uG; uniform float uSpin; uniform float uCamD;
varying float vRnd; varying float vFar; varying float vClear; varying float vGeo; varying float vMz; varying float vHide; varying float vArr; varying float vSq; varying float vGlow; varying float vTh;
uniform sampler2D tMaze; uniform sampler2D tLogo; uniform vec4 uLogo; uniform float uMaze; uniform float uRet; uniform float uVar; uniform float uBound; uniform float uDot; uniform float uLock; uniform float uToH; uniform float uFromH; uniform vec4 uLogoH; uniform float uDotH;
uniform vec4 uMask[16]; uniform float uMaskPad;
float vnoise(vec2 p){ vec2 i = floor(p), f = fract(p); f = f * f * (3. - 2. * f);
  float a = fract(sin(dot(i, vec2(127.1, 311.7))) * 43758.5), b = fract(sin(dot(i + vec2(1, 0), vec2(127.1, 311.7))) * 43758.5);
  float c = fract(sin(dot(i + vec2(0, 1), vec2(127.1, 311.7))) * 43758.5), d = fract(sin(dot(i + vec2(1, 1), vec2(127.1, 311.7))) * 43758.5);
  return mix(mix(a, b, f.x), mix(c, d, f.x), f.y); }
// distance to the nearest reading block, as soft rounded shapes
float textField(vec2 p){
  float m = 1e5;
  for (int i = 0; i < 16; i++) {
    vec4 r = uMask[i]; if (r.z <= r.x) continue;
    vec2 c = (r.xy + r.zw) * .5, h = (r.zw - r.xy) * .5;
    float rad = min(min(h.x, h.y), 36. * uDpr);
    vec2 q = abs(p - c) - h + rad;
    m = min(m, length(max(q, 0.)) + min(max(q.x, q.y), 0.) - rad);
  }
  return m;
}
void main(){
  vUv = uv;
  vec3 home = (uM * vec4(position, 1.)).xyz + uOff;
  float rnd = hash3(position * 1.37 + uOff), rnd2 = hash3(position.zyx * 2.11 + 3.1), rnd3 = hash3(position.yxz * 3.7 + 1.9);
  vec3 rel = home - uHeadC;
  vec3 rdir = normalize(vec3(rnd, rnd2, rnd3) * 2. - 1. + 1e-3);
  vec3 dir = normalize(normalize(rel + 1e-4) * .55 + rdir);
  float dist = .06 + .5 * pow(rnd2, 1.9);
  vec3 off = dir * dist * uB + rdir * uS * (.008 + .028 * rnd);
  float a = uSpin * (rnd - .5) * 1.6;
  float c = cos(a), s = sin(a);
  off.xz = mat2(c, -s, s, c) * off.xz;
  float g = clamp(uG * 1.55 - rnd3 * .55, 0., 1.);
  g = g * g * (3. - 2. * g);
  vec3 p = home + off * (1. - g);
  vFar = smoothstep(.1, .42, length(off * (1. - g)));
  vec4 mv = viewMatrix * uRigWorld * vec4(p, 1.);
  gl_Position = projectionMatrix * mv;
  // the text acts like stones in a stream: dots are pushed round it along a wobbling, living edge
  vec2 sp = (gl_Position.xy / gl_Position.w * .5 + .5) * uRes;
  // scroll: the small logo in the header, cell for cell the same grid as the big one
  vec4 mzH = texelFetch(tLogo, ivec2(int(fract(rnd * 91.7 + rnd2 * 13.1 + rnd3 * 7.3) * 65535.) % 256, int(fract(rnd * 91.7 + rnd2 * 13.1 + rnd3 * 7.3) * 65535.) / 256), 0);
  vec2 hpH = uLogoH.xy + vec2(mzH.x, 1. - mzH.y) * uLogoH.zw;
  sp = mix(sp, hpH, uFromH);
  // A: a share of the dots lands inside the logo's corridors. B: the dots become the logo itself.
  float bound = step(rnd3, uBound);
  int mi = int(fract(rnd * 91.7 + rnd2 * 13.1 + rnd3 * 7.3) * 65535.);
  ivec2 mc2 = ivec2(mi % 256, mi / 256);
  vec4 mz = uVar > .5 ? texelFetch(tLogo, mc2, 0) : texelFetch(tMaze, mc2, 0);
  vec2 mp = uLogo.xy + vec2(mz.x, 1. - mz.y) * uLogo.zw;
  mp += vec2(sin(uTime * 1.7 + rnd * 40.), cos(uTime * 1.3 + rnd2 * 30.)) * .6 * uDpr * (1. - uVar);
  // arrival: A drifts in; B rushes in from the centre outwards and snaps (quintic ease) onto its grid cell
  float arr;
  if (uVar > .5) {
    arr = clamp(uMaze * 1.65 - mz.z * .45 - rnd2 * .2, 0., 1.); arr = 1. - pow(1. - arr, 3.);
    // glide in on a curve and settle, rather than flying straight at the target
    vec2 dvA = mp - sp; vec2 ctrlA = mix(sp, mp, .55) + vec2(-dvA.y, dvA.x) * (rnd - .5) * .7;
    mp = mix(mix(sp, ctrlA, arr), mix(ctrlA, mp, arr), arr);
    arr = 1.;
  } else { arr = clamp(uMaze * 1.6 - rnd2 * .6, 0., 1.); arr = arr * arr * (3. - 2. * arr); }
  float landed = uVar > .5 ? smoothstep(.96, 1., clamp(uMaze * 1.65 - mz.z * .45 - rnd2 * .2, 0., 1.)) : 0.;
  // the way home, to the exact spot on screen where the dot belongs on the face
  vec4 hc = projectionMatrix * viewMatrix * uRigWorld * vec4(home, 1.);
  vec2 hsp = (hc.xy / hc.w * .5 + .5) * uRes;
  float r = clamp(uRet * 1.7 - (uVar > .5 ? mz.x : mz.z) * .5 - rnd * .2, 0., 1.);
  r = r * r * (3. - 2. * r);
  // A leaves through the maze's entrance in walking order and pours down into the head; B peels off in curling arcs
  vec2 ent = uLogo.xy + vec2(.603, 1.16) * uLogo.zw;
  vec2 dv2 = hsp - mp;
  vec2 ctrl = uVar > .5 ? mix(mp, hsp, .5) + vec2(-dv2.y, dv2.x) * (rnd - .5) * 1.3 : ent + vec2((rnd - .5) * .05 * uLogo.z, 0.);
  vec2 bz = mix(mix(mp, ctrl, r), mix(ctrl, hsp, r), r);
  float mk = arr * bound;
  sp = mix(sp, bz, mk);
  float th = clamp(uToH * 1.6 - rnd * .6, 0., 1.); th = th * th * (3. - 2. * th);
  vec2 dvH = hpH - sp; vec2 ctrlH = mix(sp, hpH, .45) + vec2(-dvH.y, dvH.x) * (rnd - .5) * .6;
  sp = mix(mix(sp, ctrlH, th), mix(ctrlH, hpH, th), th);
  vTh = th;
  vGeo = mz.z; vMz = mk * (1. - r); vArr = mk * r; vHide = clamp(uMaze + uRet, 0., 1.) * (1. - bound) * .92;
  vFar *= 1. - mk;
  float wob = (vnoise(sp / (90. * uDpr) + vec2(uTime * .25, -uTime * .18)) - .5) * 1.1 + (vnoise(sp / (34. * uDpr) - uTime * .4) - .5) * .5;
  float d = textField(sp) + wob * uMaskPad;
  vec2 e = vec2(2. * uDpr, 0.);
  vec2 grad = normalize(vec2(textField(sp + e.xy) - textField(sp - e.xy), textField(sp + e.yx) - textField(sp - e.yx)) + 1e-5);
  float push = smoothstep(uMaskPad * 1.6, -uMaskPad * .4, d) * uMaskPad * (.7 + .8 * rnd) * (1. - mk) * (1. - th);
  sp += grad * push;
  gl_Position.xy = ((sp / uRes) * 2. - 1.) * gl_Position.w;
  vClear = max(max(mk, th), smoothstep(-uMaskPad * .2, uMaskPad * .9, d + push * .55 + (rnd2 - .5) * uMaskPad * .8));
  gl_PointSize = clamp(uDpr * 1.75 * (uCamD / max(-mv.z, .05)) * (1. + .6 * rnd * uB * (1. - g)) * (1. - .45 * vFar), uDpr, 10. * uDpr);
  float szA = (1.7 + 1.6 * sin(3.1416 * r)) * uDpr;
  // B: a landed dot fills its whole cell, so the particle logo is the logo; then the cells shrink centre-out and it shows its grain
  float shr = clamp(uLock * 1.6 - mz.z * .6, 0., 1.); shr = shr * shr * (3. - 2. * shr);
  float bx = fract(uTime * .18) * 1.5 - .25;
  float sweep = exp(-pow((mz.x - bx) / .05, 2.)) * shr;
  float szB = mix(1.9 * uDpr, uDot * mix(1.0, .7, shr) * (1. + .22 * sweep), landed);
  szB = mix(szB, (1.7 + 1.6 * sin(3.1416 * r)) * uDpr, r);
  gl_PointSize = mix(gl_PointSize, mix(szA, szB, uVar), mk);
  gl_PointSize = mix(gl_PointSize, max(1.25 * uDpr, uDotH), th);
  vHide *= 1. - uToH; vFar *= 1. - th;
  vSq = uVar * mk * (1. - r) * landed; vGlow = uVar * mk * (1. - r) * max(sweep * .35, (1. - landed) * .18);
  vRnd = rnd;
}`;
const SHOW_F = FH + `
uniform float uInkMix; uniform float uAlpha; uniform float uSolve; uniform float uVar; varying float vRnd; varying float vFar; varying float vClear; varying float vGeo; varying float vMz; varying float vHide; varying float vArr; varying float vSq; varying float vGlow; varying float vTh;
void main(){
  if (vArr > .82 && fract(vRnd * 3.7) < (vArr - .82) * 6.) discard;   // a dot vanishes as it lands; the code takes its place
  vec2 q = gl_PointCoord - .5;
  if ((vSq < .5 && dot(q, q) > .25) || vRnd > uAlpha || (fract(vRnd * 13.7) < .7375 && vSq < .5 && vMz < .5)) discard;
  if (vSq > .5 && max(abs(q.x), abs(q.y)) > .5) discard;
  if (fract(vRnd * 29.1) < .3) discard;   // 30% fewer dots everywhere; the logo cells still overlap, so it stays solid
  cutout();
  if (fract(vRnd * 31.3) > vClear || fract(vRnd * 5.3) < vHide) discard;
  // ink and greys only
  vec3 tone = vRnd > .86 ? mix(uInk, uPaper, .55) : (vRnd > .66 ? mix(uInk, uPaper, .3) : uInk);
  // the further a dot has flown, the lighter it gets, so the cover text stays readable
  vec3 c = mix(mix(albedo(), tone, uInkMix), uPaper, vFar * .62);
  // inside the maze: waiting dots are pale, a teal front walks the corridors from the entrance
  float solved = step(vGeo, uSolve);
  float band = exp(-pow((vGeo - uSolve) / .03, 2.));
  vec3 mc = mix(mix(uInk, uPaper, .72), mix(uInk, uPaper, .18), solved);
  mc = mix(mc, uInk, band);
  vec3 lc = mix(uInk, uPaper, vGlow * .45);
  c = mix(c, uVar > .5 ? lc : mc, vMz);
  c = mix(c, uInk, vTh);
  gl_FragColor = vec4(c, 1.);
  #include <colorspace_fragment>
}`;

/* screen-space passes read the photo render */
const QV = `varying vec2 vUv; void main(){ vUv = uv; gl_Position = vec4(position.xy, 0., 1.); }`;
const QH = `
uniform sampler2D tScene; uniform vec2 uRes; uniform vec3 uPtr; uniform float uDpr; uniform float uTime;
uniform vec3 uInk; uniform vec3 uTeal; uniform vec3 uTealLt;
vec3 toS(vec3 c){ return pow(max(c, 0.), vec3(1. / 2.2)); }
float luma(vec3 c){ return dot(toS(c), vec3(.299, .587, .114)); }
float hash2(vec2 p){ return fract(sin(dot(p, vec2(127.1, 311.7))) * 43758.5453); }
float lensAt(vec2 fc, out float ring){
  float d = distance(fc, uPtr.xy), r = uPtr.z, on = step(1., r);
  ring = (1. - smoothstep(0., 1.6 * uDpr, abs(d - r + uDpr))) * on;
  return (1. - smoothstep(r - 1.5 * uDpr, r + 1.5 * uDpr, d)) * on;
}
`;
/* 1 · Meio-tom: riso duotone, ink at 45°, mint at 15°, a hair off register */
const HALF_F = QH + `
float plate(vec2 fc, float ang, float cell, float gam, float gain){
  float c = cos(ang), s = sin(ang); mat2 R = mat2(c, -s, s, c);
  vec2 p = R * fc; vec2 ctr = (floor(p / cell) + .5) * cell; vec2 cs = ctr * R;
  vec4 t = texture2D(tScene, cs / uRes);
  float L = clamp((luma(t.rgb / max(t.a, 1e-3)) - .08) / .8, 0., 1.);
  float ink = pow(1. - L, gam) * gain * smoothstep(.3, .7, t.a);
  float rad = cell * .5 * sqrt(ink) * 1.32;
  return (1. - smoothstep(rad - .8 * uDpr, rad + .8 * uDpr, length(p - ctr))) * step(.02, ink);
}
void main(){
  vec2 fc = gl_FragCoord.xy;
  float cell = 6. * uDpr;
  float k = plate(fc, .785, cell, 1.25, 1.);
  float m = plate(fc + vec2(1.6, -1.1) * uDpr, .26, cell, .75, .62);
  vec3 c = mix(uTealLt, uInk, k);
  float a = clamp(k + m * (1. - k), 0., 1.);
  vec4 o = vec4(c * a, a);
  float ring; float inL = lensAt(fc, ring);
  vec4 photo = texture2D(tScene, fc / uRes);
  o = mix(o, photo, inL);
  o = mix(o, vec4(uTeal, 1.), ring * max(photo.a, .0));
  gl_FragColor = o;
  #include <colorspace_fragment>
}`;
/* 4 · ASCII: luminance → glyph ramp in Geist Mono; the lens doubles the grid in teal */
const ASCII_F = QH + `
uniform sampler2D tGlyph; uniform float uN; uniform float uLod; uniform float uAmt; uniform float uScr; uniform float uReveal; uniform float uRevMode;
float scrOn = 0.;
float glyph(vec2 fc, vec2 cell, float lod, float flick){
  vec2 ci = floor(fc / cell); vec2 ctr = (ci + .5) * cell;
  vec4 t = texture2D(tScene, ctr / uRes);
  if (t.a < .5) return 0.;
  float L = pow(clamp((luma(t.rgb / max(t.a, 1e-3)) - .18) / .66, 0., 1.), 1.7);
  float idx = floor((1. - L) * (uN - 1.) + .5);
  if (flick > 0. && hash2(ci + floor(uTime * 2.3)) > .992) idx = 1. + floor(hash2(ci * 1.7 + floor(uTime)) * (uN - 1.));
  if (uScr > 0. && hash2(ci + floor(uTime * 15.)) < uScr) { idx = 1. + floor(hash2(ci * 3.1 + floor(uTime * 15.)) * (uN - 1.)); scrOn = 1.; }
  vec2 g = fract(fc / cell);
  return textureLod(tGlyph, vec2((idx + g.x) / uN, g.y), lod).r;
}
void main(){
  vec2 fc = gl_FragCoord.xy;
  vec2 cell = vec2(5.2, 8.9) * uDpr;
  float ring; float inL = lensAt(fc, ring);
  float g1 = glyph(fc, cell, uLod, 1.);
  float g2 = inL > 0. ? glyph(fc, cell * .5, uLod + 1., 0.) : 0.;
  float g = mix(g1, g2, inL);
  vec3 c = mix(mix(uInk, uTeal, scrOn), uTeal, inL);
  vec4 o = vec4(c * g, g) * uAmt;
  vec4 photo = texture2D(tScene, fc / uRes);
  float ra = step(.5, photo.a);
  o = mix(o, vec4(uTeal, 1.), ring * max(ra, .35));
  if (uReveal > 0.) {
    vec2 cc = floor(fc / cell);
    float hr = hash2(cc * .73 + 5.);
    // stream mode: the photo arrives like data, row by row from the top, in runs of random length
    float run = hash2(vec2(floor(cc.x / (3. + floor(hash2(vec2(cc.y, 3.)) * 9.))), cc.y));
    float rowT = 1. - fc.y / uRes.y;
    hr = mix(hr, clamp(rowT * .86 + run * .14, 0., 1.), uRevMode);
    float rev = step(hr, uReveal);
    float edge = step(hr, uReveal + .07) * (1. - rev);
    o = mix(o, vec4(1.), edge * ra);
    o = mix(o, photo, rev);
  }
  gl_FragColor = o;
  #include <colorspace_fragment>
}`;

/* ---------- glyph atlas ---------- */
const RAMP = ' .:-=+*#%@';
function glyphAtlas() {
  const cw = 64, ch = 110, cv = document.createElement('canvas');
  cv.width = cw * RAMP.length; cv.height = ch;
  const g = cv.getContext('2d');
  g.fillStyle = '#000'; g.fillRect(0, 0, cv.width, cv.height);
  g.fillStyle = '#fff'; g.font = '500 86px "Geist Mono", ui-monospace, Menlo, monospace';
  g.textAlign = 'center'; g.textBaseline = 'middle';
  [...RAMP].forEach((c, i) => g.fillText(c, i * cw + cw / 2, ch / 2 + 4));
  const tx = new THREE.CanvasTexture(cv);
  tx.minFilter = THREE.LinearMipmapLinearFilter; tx.generateMipmaps = true;
  return tx;
}

/* ---------- screen passes ---------- */
const rt = new THREE.WebGLRenderTarget(2, 2, { samples: 4 });
const qCam = new THREE.OrthographicCamera(-1, 1, 1, -1, 0, 1);
const qScene = new THREE.Scene();
const quad = new THREE.Mesh(new THREE.PlaneGeometry(2, 2)); quad.frustumCulled = false; qScene.add(quad);
const qU = { tScene: { value: rt.texture }, uRes: U.uRes, uPtr: U.uPtr, uDpr: U.uDpr, uTime: U.uTime, uInk: U.uInk, uTeal: U.uTeal, uTealLt: U.uTealLt };
const halfMat = new THREE.ShaderMaterial({ uniforms: qU, vertexShader: QV, fragmentShader: HALF_F, blending: THREE.NoBlending, depthTest: false, depthWrite: false });
const asciiMat = new THREE.ShaderMaterial({ uniforms: { ...qU, tGlyph: { value: null }, uN: { value: RAMP.length }, uLod: { value: 0 }, uAmt: { value: 1 }, uScr: { value: 0 }, uReveal: { value: 0 }, uRevMode: { value: 0 } }, vertexShader: QV, fragmentShader: ASCII_F, blending: THREE.NoBlending, depthTest: false, depthWrite: false });
(document.fonts && document.fonts.load ? document.fonts.load('500 86px "Geist Mono"') : Promise.resolve()).catch(() => {}).then(() => { asciiMat.uniforms.tGlyph.value = glyphAtlas(); });

/* ---------- load + split the bust ---------- */
const nose = new THREE.Vector3(0, 0.26, 0.1);
const skinMat = new THREE.MeshBasicMaterial({ color: 0xB88468, side: THREE.DoubleSide });
const parts = []; let H = 0.393, center = new THREE.Vector3(0, 0.2, 0), faceMesh = null;
function bytes(b64) { const s = atob(b64), u = new Uint8Array(s.length); for (let i = 0; i < s.length; i++) u[i] = s.charCodeAt(i); return u.buffer; }
const ready = new Promise(resolve => {
  const loader = new GLTFLoader();
  const done = g => {
    const box = new THREE.Box3().setFromObject(g.scene);
    center = box.getCenter(new THREE.Vector3()); H = box.getSize(new THREE.Vector3()).y;
    pivot.position.set(0, 0.215, 0.005);
    const kids = []; g.scene.traverse(o => { if (o.isMesh) kids.push(o); });
    g.scene.updateMatrixWorld(true);
    kids.forEach(m => {
      const torso = TORSO.some(n => (m.name + ' ' + (m.parent && m.parent.name)).indexOf(n) > -1);
      (torso ? rig : pivot).attach(m);
      if (!m.geometry.attributes.normal) m.geometry.computeVertexNormals();
      m.updateMatrix();
      if (/rosto/.test(m.name)) faceMesh = m;
      const orig = m.material;
      const own = { uM: { value: m.matrix.clone() }, uOff: { value: m.parent.position.clone() },
        uMap: { value: orig.map || null }, uHasMap: { value: orig.map ? 1 : 0 }, uCut: { value: orig.alphaTest || 0 }, uColor: { value: orig.color ? orig.color.clone() : col(0x999999) } };
      const mk = (vs, fs, extra) => new THREE.ShaderMaterial({ uniforms: { ...U, ...own, ...(extra || {}) }, vertexShader: vs, fragmentShader: fs, side: THREE.DoubleSide });
      const sliceN = { uN: { value: 46 } };
      const mats = {
        curvas: mk(VH + VBASE, TOPO_F),
        fatias: mk(SLICE_V, SLICE_F, sliceN),
        pulso: mk(WAVE_V, WAVE_F)
      };
      const pg = new THREE.BufferGeometry();
      pg.setAttribute('position', m.geometry.attributes.position);
      if (m.geometry.attributes.uv) pg.setAttribute('uv', m.geometry.attributes.uv);
      const pts = new THREE.Points(pg, mk(PTS_V, PTS_F));
      pts.position.copy(m.position); pts.quaternion.copy(m.quaternion); pts.scale.copy(m.scale);
      pts.visible = false; m.parent.add(pts);
      const showMat = mk(SHOW_V, SHOW_F); pts.frustumCulled = false;
      parts.push({ mesh: m, orig, mats, pts, ptsMat: pts.material, showMat, eye: /olho/.test(m.name) });
    });
    // the ASCII never shows the eyeballs: they get a flat skin tone averaged from the face texture
    try {
      const img = faceMesh && faceMesh.material.map && faceMesh.material.map.image;
      const cv = document.createElement('canvas'); cv.width = cv.height = 16; const g2 = cv.getContext('2d');
      g2.drawImage(img, img.width * 0.3, img.height * 0.3, img.width * 0.4, img.height * 0.4, 0, 0, 16, 16);
      const d = g2.getImageData(0, 0, 16, 16).data; let r = 0, gg = 0, b = 0;
      for (let i = 0; i < d.length; i += 4) { r += d[i]; gg += d[i + 1]; b += d[i + 2]; }
      const n = d.length / 4; skinMat.color.setRGB(r / n / 255, gg / n / 255, b / n / 255, THREE.SRGBColorSpace);
    } catch (e) {}
    // where the chin sits inside the framed box (for the portrait framing)
    const lips = kids.find(k => /lábios/.test(k.name));
    if (lips) { const lb = new THREE.Box3().setFromObject(lips); const chinY = lb.min.y - 0.035;
      frameF.chin = .5 - (chinY - center.y - 0.02) * 0.95 / H; frameF.cap = .5 - (H / 2 - 0.02) * 0.95 / H; }
    // head centre and nose tip, in rig space, for the choreography
    const hbx = new THREE.Box3().setFromObject(pivot); hbx.getCenter(U.uHeadC.value); U.uHeadC.value.y -= 0.01;
    if (faceMesh) { const pa = faceMesh.geometry.attributes.position, t3 = new THREE.Vector3(); let bz = -1e9;
      for (let i = 0; i < pa.count; i += 3) { t3.fromBufferAttribute(pa, i).applyMatrix4(faceMesh.matrix).add(faceMesh.parent.position); if (t3.z > bz) { bz = t3.z; nose.copy(t3); } } }
    resolve();
  };
  loader.load(CV.model, done, undefined, () => cvRoot.classList.add('cv-fallback'));
});

/* ---------- the logo as a maze: corridor samples + walking distance from the entrance ---------- */
const LOGO_PITCH = 8.99 / 6;   // six cells per stroke, so the grid sits exactly on the logo's own module
(function buildMaze() {
  const N = 256, W0 = 305.55, H0 = 98.86, S = 3;
  const gw = Math.ceil(W0 * S), gh = Math.ceil(H0 * S);
  const cv = document.createElement('canvas'); cv.width = gw; cv.height = gh;
  const g = cv.getContext('2d');
  g.setTransform(S, 0, 0, S, -9.45 * S, -13.36 * S);
  const paths = [...cvRoot.querySelectorAll('.mast path')].map(el => new Path2D(el.getAttribute('d')));
  g.fillStyle = g.strokeStyle = '#000';
  paths.forEach(P => g.fill(P));
  const ink = g.getImageData(0, 0, gw, gh).data;
  g.lineWidth = 3.2; g.lineJoin = 'miter'; paths.forEach(P => g.stroke(P));
  const px = g.getImageData(0, 0, gw, gh).data, n = gw * gh;
  const free = new Uint8Array(n); for (let i = 0; i < n; i++) free[i] = px[i * 4 + 3] < 30 ? 1 : 0;
  // walk from the gap in the top bar (the maze's entrance)
  const dist = new Int32Array(n).fill(-1), q = new Int32Array(n);
  let sx = Math.round((193.7 - 9.45) * S), sy = Math.round((16 - 13.36) * S), start = -1;
  for (let r = 0; r < 40 && start < 0; r++) for (let dy = -r; dy <= r && start < 0; dy++) for (let dx = -r; dx <= r; dx++) {
    const x = sx + dx, y = sy + dy; if (x >= 0 && y >= 0 && x < gw && y < gh && free[y * gw + x]) { start = y * gw + x; break; } }
  let h = 0, t = 0, maxd = 1;
  if (start >= 0) { dist[start] = 0; q[t++] = start; }
  while (h < t) { const c = q[h++], x = c % gw, y = (c / gw) | 0, d = dist[c] + 1;
    if (d > maxd) maxd = d;
    if (x > 0 && free[c - 1] && dist[c - 1] < 0) { dist[c - 1] = d; q[t++] = c - 1; }
    if (x < gw - 1 && free[c + 1] && dist[c + 1] < 0) { dist[c + 1] = d; q[t++] = c + 1; }
    if (y > 0 && free[c - gw] && dist[c - gw] < 0) { dist[c - gw] = d; q[t++] = c - gw; }
    if (y < gh - 1 && free[c + gw] && dist[c + gw] < 0) { dist[c + gw] = d; q[t++] = c + gw; } }
  const cells = []; for (let i = 0; i < n; i++) if (free[i]) cells.push(i);
  const data = new Float32Array(N * N * 4);
  for (let k = 0; k < N * N; k++) {
    const c = cells[(Math.random() * cells.length) | 0] || 0;
    data[k * 4] = ((c % gw) + Math.random()) / gw; data[k * 4 + 1] = (((c / gw) | 0) + Math.random()) / gh;
    data[k * 4 + 2] = dist[c] >= 0 ? dist[c] / maxd : 1.02; data[k * 4 + 3] = 1;
  }
  const tx = new THREE.DataTexture(data, N, N, THREE.RGBAFormat, THREE.FloatType);
  tx.needsUpdate = true; U.tMaze.value = tx;
  // the strokes themselves, for the particle logo
  const P = LOGO_PITCH, cells2 = [];
  for (let y = 9.45 * 0 + P / 2; y < H0; y += P) for (let x = P / 2; x < W0; x += P) {
    const ix = Math.min(gw - 1, Math.round(x * S)), iy = Math.min(gh - 1, Math.round(y * S));
    if (ink[(iy * gw + ix) * 4 + 3] > 128) cells2.push([x / W0, y / H0, Math.hypot((x - W0 / 2) / W0, (y - H0 / 2) / H0 * .55)]);
  }
  const mxz = cells2.reduce((m, c) => Math.max(m, c[2]), 1e-3);
  for (let i = cells2.length - 1; i > 0; i--) { const j = (Math.random() * (i + 1)) | 0; [cells2[i], cells2[j]] = [cells2[j], cells2[i]]; }
  const d2 = new Float32Array(N * N * 4);
  for (let k = 0; k < N * N; k++) { const c = cells2[k % cells2.length]; d2[k * 4] = c[0]; d2[k * 4 + 1] = c[1]; d2[k * 4 + 2] = c[2] / mxz; d2[k * 4 + 3] = 1; }
  const t2 = new THREE.DataTexture(d2, N, N, THREE.RGBAFormat, THREE.FloatType);
  t2.needsUpdate = true; U.tLogo.value = t2;
})();

/* ---------- reading text the particles avoid (device px, y up) ---------- */
function measureText(cr) {
  const els = [...cvRoot.querySelectorAll('.frame .cl > *, #chips, #how')];
  const M = U.uMask.value; let i = 0;
  els.forEach(el => {
    if (i >= M.length) return;
    const r = el.getBoundingClientRect(); if (!r.width || !r.height) return;
    M[i++].set((r.left - cr.left) * dpr, (cr.bottom - r.bottom) * dpr, (r.right - cr.left) * dpr, (cr.bottom - r.top) * dpr);
  });
  for (; i < M.length; i++) M[i].set(0, 0, 0, 0);
  U.uMaskPad.value = 34 * dpr;
  const lr = cvRoot.querySelector('.mast svg').getBoundingClientRect();
  U.uLogo.value.set((lr.left - cr.left) * dpr, (cr.bottom - lr.bottom) * dpr, lr.width * dpr, lr.height * dpr);
  U.uDot.value = Math.max(1.5 * dpr, lr.width * dpr / 305.55 * LOGO_PITCH * 1.08);
}
if (document.fonts && document.fonts.ready) document.fonts.ready.then(() => resize());
/* ---------- portrait framing: cap over the logo's edge, chin above the headline ---------- */
const stackedMQ = window.matchMedia('(max-aspect-ratio:4/5),(max-width:760px)');
const frameF = { cap: 0.044, chin: 0.42 };
function layoutBust() {
  const box = cvRoot.querySelector('#bustBox');
  box.style.top = ''; box.style.height = '';
  if (!stackedMQ.matches) return;
  const hero = cvRoot.getBoundingClientRect();
  const lg = cvRoot.querySelector('.mast svg').getBoundingClientRect();
  const c3 = cvRoot.querySelector('.c3').getBoundingClientRect();
  const L = lg.bottom - hero.top, S = c3.top - hero.top - 14, bw = box.getBoundingClientRect().width || innerWidth;
  if (S - L < 60) return;
  // the camera fits the bust by height until the box gets narrower than 1/1.35 of it; cap the box there so the framing stays exact
  const a = frameF.cap, b = frameF.chin;
  const h = Math.max(120, Math.min((S - L) / (.86 * (b - a)), bw * 1.35));
  const t = L - (a + .14 * (b - a)) * h;
  box.style.top = t.toFixed(1) + 'px'; box.style.height = h.toFixed(1) + 'px';
}
/* ---------- sizing ---------- */
let W = 1, Hh = 1;
function resize() {
  const r = canvas.getBoundingClientRect();
  W = Math.max(1, r.width); Hh = Math.max(1, r.height);
  renderer.setSize(W, Hh, false);
  U.uRes.value.set(W * dpr, Hh * dpr);
  rt.setSize(Math.round(W * dpr), Math.round(Hh * dpr));
  asciiMat.uniforms.uLod.value = Math.max(0, Math.log2(64 / (5.2 * dpr)));
  layoutBust();
  const bb = cvRoot.querySelector('#bustBox').getBoundingClientRect();
  const bw = Math.max(1, bb.width), bh = Math.max(1, bb.height);
  camera.aspect = bw / bh;
  camera.setViewOffset(bw, bh, -(bb.left - r.left), -(bb.top - r.top), W, Hh);
  const dist = (H / 0.95) / (2 * Math.tan(THREE.MathUtils.degToRad(camera.fov / 2)));
  camera.position.set(0, center.y + 0.01, dist / Math.min(1, camera.aspect * 1.35));
  camera.lookAt(0, center.y + 0.02, 0);
  U.uCamD.value = camera.position.z;
  measureText(r);
  camera.updateProjectionMatrix();
}
window.addEventListener('resize', resize);
if ('ResizeObserver' in window) new ResizeObserver(resize).observe(canvas);

/* ---------- pointer ---------- */
const st = { look: { x: 0, y: 0 }, cur: { x: 0, y: 0 }, last: -1e5, px: -9999, py: -9999, seen: false, lr: 0, open: 0 };
window.addEventListener('pointermove', e => {
  st.look.x = (e.clientX / innerWidth) * 2 - 1; st.look.y = (e.clientY / innerHeight) * 2 - 1;
  st.last = performance.now(); st.px = e.clientX; st.py = e.clientY; st.seen = true;
  if (fx.id === 'pulso') dropAt(e.clientX, e.clientY, 0.6, 900);
}, { passive: true });
document.addEventListener('pointerleave', () => { st.seen = false; readout.hidden = true; });
cvRoot.addEventListener('pointerdown', e => {
  if (isShow() && show.on) { show.pulseFrom = pick(e.clientX, e.clientY); startShow(); } st.px = e.clientX; st.py = e.clientY; st.seen = true; st.last = performance.now(); if (fx.id === 'pulso') dropAt(e.clientX, e.clientY, 1, 0); });

/* ripples: raycast the face, store hits in rig space (the same space the shader uses) */
const ray = new THREE.Raycaster(), ndc = new THREE.Vector2();
let hitSlot = 0, lastDrop = 0;
function pushHit(p, k) { U.uHit.value[hitSlot].set(p.x, p.y, p.z, U.uTime.value); U.uHitK.value[hitSlot] = k; hitSlot = (hitSlot + 1) % 8; }
function pick(cx, cy) {
  if (!parts.length) return null;
  const r = canvas.getBoundingClientRect();
  ndc.set(((cx - r.left) / r.width) * 2 - 1, -((cy - r.top) / r.height) * 2 + 1);
  ray.setFromCamera(ndc, camera);
  const hit = ray.intersectObjects(parts.map(p => p.mesh), false)[0];
  return hit ? hit.object.parent.worldToLocal(hit.point.clone()).add(hit.object.parent.position) : null;
}
function dropAt(cx, cy, k, throttle) {
  const now = performance.now(); if (now - lastDrop < throttle) return; lastDrop = now;
  const p = pick(cx, cy); if (p) pushHit(p, k);
}
/* a small mono readout follows the pointer over the face: surface coordinates of the mesh */
const readout = cvRoot.querySelector('#readout');
let lastRead = 0;
const f3 = n => (n >= 0 ? '+' : '−') + Math.abs(n * 100).toFixed(2);
function readAt(cx, cy) {
  const now = performance.now(); if (now - lastRead < 50) return; lastRead = now;
  const p = pick(cx, cy);
  if (!p) { readout.hidden = true; return; }
  readout.hidden = false;
  readout.style.transform = 'translate(' + Math.round(cx + 22) + 'px,' + Math.round(cy + 18) + 'px)';
  readout.textContent = 'x ' + f3(p.x) + '  y ' + f3(p.y - center.y) + '  z ' + f3(p.z);
}
const tmp = new THREE.Vector3();
function dropRandom() {
  if (!faceMesh) return;
  const pa = faceMesh.geometry.attributes.position;
  for (let n = 0; n < 12; n++) {
    tmp.fromBufferAttribute(pa, Math.floor(Math.random() * pa.count)).applyMatrix4(faceMesh.matrix).add(faceMesh.parent.position);
    if (tmp.z > center.z + 0.03) { pushHit(tmp, 0.85); return; }
  }
}

/* ---------- switching ---------- */
let fx = FX[0];
const isShow = () => fx.id === 'show' || fx.id === 'show-logo';
const beats = () => ['Foto', 'Voo', fx.id === 'show-logo' ? 'Logo' : 'Labirinto', 'Retorno', 'Código', 'Voo', 'Foto'];
const CYCLE = 21.5;
const mastEl = cvRoot.querySelector('.mast');
const show = { on: false, t0: 0, beat: -1, fw: 1, cyc: -1, fromH: false };
const SCROLL_SIM = true;
const sim = { p: 0, formed: false, active: false, lastY: 0, lastT: 0, vel: 0, rebuild: -1 };
const hdrEl = document.querySelector('.site-header') || document.createElement('header'), hdrLogo = hdrEl.querySelector('.brand svg') || cvRoot.querySelector('.mast svg');
function startShow() { show.t0 = performance.now() - 900; show.cyc = -1; show.paused = null; }
/* a small remote so a page around this one can scrub the choreography */
const beatTimes = () => { const D = fx.id === 'show-logo' ? 1.2 : 0; return [['Foto', 0], ['Onda', 1.0], ['Voo', 3.0], [fx.id === 'show-logo' ? 'Logo' : 'Labirinto', 3.7], ['Retorno', 6.7 + D], ['Código', 9.2 + D], ['Voo', 15.1], ['Foto', 18.4]]; };
window.__show = {
  seek(t) { t = Math.max(0, Math.min(CYCLE - .01, t)); show.t0 = performance.now() - t * 1000; show.cyc = t >= 3 ? 0 : -1; if (show.paused != null) show.paused = t; },
  pause() { if (show.paused == null) show.paused = ((performance.now() - show.t0) / 1000) % CYCLE; },
  play() { if (show.paused != null) { const t = show.paused; show.paused = null; this.seek(t); } },
  state() { return { T: show.paused != null ? show.paused : ((performance.now() - show.t0) / 1000) % CYCLE, cycle: CYCLE, paused: show.paused != null, beats: beatTimes() }; }
};
const chips = cvRoot.querySelector('#chips'), how = cvRoot.querySelector('#how');
FX.forEach((f, i) => {
  const b = document.createElement('button'); b.type = 'button'; b.id = 'fx-' + f.id; b.dataset.id = f.id;
  b.innerHTML = '<span>' + (i + 1) + '</span>' + f.name;
  b.addEventListener('click', () => { location.hash = f.id; });
  chips.appendChild(b);
});
function setFx(id) {
  fx = FX.find(f => f.id === id) || FX[0];
  chips.querySelectorAll('button').forEach(b => b.setAttribute('aria-pressed', String(b.dataset.id === fx.id)));
  how.innerHTML = isShow()
    ? beats().map((b, i) => '<i data-b="' + i + '">' + b + '</i>').join(' · ') + ' · <b>toque para recomeçar</b>'
    : fx.how;
  show.on = isShow() && !reduce;
  U.uVar.value = fx.id === 'show-logo' ? 1 : 0; U.uBound.value = fx.id === 'show-logo' ? 1 : 0.56;
  mastEl.style.opacity = ''; show.t0 = performance.now(); show.beat = -1; show.cyc = -1;
  const btn = cvRoot.querySelector('#fx-' + fx.id); if (btn && btn.scrollIntoView) btn.scrollIntoView({ block: 'nearest', inline: 'center' });
  parts.forEach(p => {
    p.mesh.visible = fx.id !== 'particulas'; p.pts.visible = fx.id === 'particulas'; p.pts.material = p.ptsMat;
    p.mesh.material = p.mats[fx.id] || p.orig;
  });
  readout.hidden = true;
  if (fx.id === 'pulso') { dropRandom(); }
}
const fromHash = () => setFx('show-logo');
window.addEventListener('keydown', e => { const n = parseInt(e.key, 10); if (n >= 1 && n <= FX.length && !e.metaKey && !e.ctrlKey && !e.altKey) location.hash = FX[n - 1].id; });

/* ---------- loop ---------- */
const v = new THREE.Vector3(), hb = new THREE.Box3();
let autoT = 0;
const cl = x => Math.min(1, Math.max(0, x));
const sm = (a, b, x) => { const t = cl((x - a) / (b - a)); return t * t * (3 - 2 * t); };
const ease = t => t < .5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
/* the loop: photo → flight → ASCII → flight → photo. The particles never settle into the 3D face:
   they fade out while still in the air and the next state comes in under them, cell by cell. */
function flight(T, t0, gAt) {
  const l = T - t0;
  U.uB.value = 1 - Math.pow(2, -9 * cl(l / 1.1));
  U.uS.value = Math.max(0, l); U.uSpin.value = 0.45 * Math.max(0, l);
  U.uG.value = cl((l - gAt) / 2.2);
}
function drawMeshes(mode) {
  parts.forEach(p => { p.mesh.visible = true; p.pts.visible = false; p.mesh.material = mode === 'pulse' ? p.mats.pulso : (mode === 'ascii' && p.eye ? skinMat : p.orig); });
}
/* scrolling down gathers everything into the header logo; back at the top it bursts and the loop picks up */
function renderScroll(P) {
  const A = asciiMat.uniforms;
  U.uVar.value = 1; U.uBound.value = 1; U.uFromH.value = 0;
  U.uB.value = (1 - Math.pow(1 - cl(P / .3), 3)) * .55; U.uS.value = P * 1.2; U.uSpin.value = P * .8; U.uG.value = 0;
  U.uMaze.value = 0; U.uRet.value = 0; U.uLock.value = 0;
  U.uToH.value = sm(.2, .96, P); U.uInkMix.value = sm(.04, .3, P);
  const formed = P > .965;
  hdrEl.classList.toggle('logo-on', formed);
  if (formed) sim.formed = true;
  rig.updateMatrixWorld(true); U.uRigWorld.value.copy(rig.matrixWorld);
  drawMeshes('photo');
  renderer.setRenderTarget(rt); renderer.clear(); renderer.render(scene, camera); renderer.setRenderTarget(null);
  A.uAmt.value = 0; A.uScr.value = 0; A.uReveal.value = (1 - sm(0, .16, P)) * 1.08;
  quad.material = asciiMat; renderer.render(qScene, qCam);
  A.uAmt.value = 1; A.uReveal.value = 0;
  if (!formed) {
    U.uAlpha.value = .55;
    parts.forEach(p => { p.mesh.visible = false; p.pts.visible = !p.eye; p.pts.material = p.showMat; });
    const ac = renderer.autoClear; renderer.autoClear = false; renderer.clearDepth();
    renderer.render(scene, camera); renderer.autoClear = ac;
  }
  U.uToH.value = 0;
}
function renderRebuild(k) {
  const A = asciiMat.uniforms;
  drawMeshes('photo');
  renderer.setRenderTarget(rt); renderer.clear(); renderer.render(scene, camera); renderer.setRenderTarget(null);
  A.uAmt.value = 0; A.uScr.value = 0; A.uReveal.value = k * 1.1; A.uRevMode.value = 1;
  quad.material = asciiMat; renderer.render(qScene, qCam);
  A.uAmt.value = 1; A.uReveal.value = 0; A.uRevMode.value = 0;
}
function simTick(now) {
  if (!SCROLL_SIM) return false;
  // scroll speed (px/s, negative going up), smoothed
  const dt = Math.max(1, now - (sim.lastT || now - 16)); const v = (window.scrollY - sim.lastY) / dt * 1000;
  sim.vel += (v - sim.vel) * .35; sim.lastY = window.scrollY; sim.lastT = now;
  const fastUp = Math.min(v, sim.vel) < -innerHeight * 1.2;   // a flick back to the top
  if (sim.rebuild >= 0) {
    const k = cl((now - sim.rebuild) / 950);
    renderRebuild(k);
    if (k >= 1) { sim.rebuild = -1; show.t0 = now; show.cyc = -1; show.fromH = false; show.paused = null; }
    return true;
  }
  const cr = canvas.getBoundingClientRect(), hr = hdrLogo.getBoundingClientRect();
  U.uLogoH.value.set((hr.left - cr.left) * dpr, (cr.bottom - hr.bottom) * dpr, hr.width * dpr, hr.height * dpr);
  U.uDotH.value = hr.width * dpr / 305.55 * LOGO_PITCH * 1.15;
  // sweet spot: a short dead zone so a stray flick does nothing, then the small logo finishes forming
  // exactly as the big one slides under the header
  const mb = mastEl.getBoundingClientRect().bottom + window.scrollY, hb = Math.max(56, hdrEl.getBoundingClientRect().bottom);
  const start = innerHeight * .1, end = Math.max(start + 160, (mb - hb) * .96);
  const target = cl((window.scrollY - start) / (end - start));
  sim.p += (target - sim.p) * (1 - Math.exp(-dt / 110));   // time-based, same feel at any frame rate
  if (sim.formed) {
    // the logo holds while you read; only the way back to the top sets it free
    if (target > .12) { hdrEl.classList.add('logo-on'); renderer.clear(); return true; }
    sim.formed = false; sim.p = 0; hdrEl.classList.remove('logo-on');
    if (true) { sim.rebuild = now; sim.active = false; show.t0 = now; show.paused = null; renderRebuild(0); return true; }   // a quick flick home: rebuild from bytes, no flight
    show.t0 = now - 3050; show.cyc = 0; show.paused = null; show.fromH = true;
    return false;
  }
  if (sim.active && target < sim.p - .05) { sim.active = false; sim.p = 0; hdrEl.classList.remove('logo-on'); sim.rebuild = now; show.t0 = now; show.paused = null; renderRebuild(0); return true; }
  if (sim.p > .004) { if (!sim.active) { sim.active = true; } renderScroll(sim.p); return true; }
  if (sim.active) { sim.active = false; show.t0 = now; show.cyc = -1; show.fromH = false; }
  return false;
}
function renderShow(now, T) {
  const A = asciiMat.uniforms;
  if (simTick(now)) return;
  U.uFromH.value = show.fromH && T < 7.9 ? 1 : 0;
  if (show.fromH && T >= 7.9) show.fromH = false;
  U.uPtr.value.z = 0;
  const DB = U.uVar.value > .5 ? 1.2 : 0;
  const beat = T < 0 ? -1 : T < 3.0 ? 0 : T < 3.7 ? 1 : T < 6.7 + DB ? 2 : T < 9.2 + DB ? 3 : T < 15.1 ? 4 : T < 18.4 ? 5 : 6;
  if (beat !== show.beat) { show.beat = beat; how.querySelectorAll('i').forEach(el => el.classList.toggle('on', +el.dataset.b === beat)); }
  const cyc = Math.floor((now - show.t0) / 1000 / CYCLE);
  if (T >= 1.0 && show.cyc !== cyc) { show.cyc = cyc; for (let i = 0; i < 8; i++) U.uHitK.value[i] = 0; pushHit(show.pulseFrom || nose, 1); show.pulseFrom = null; }
  U.uWaveV.value = 0.2; U.uWaveF.value = 0.12;
  U.uMaze.value = 0; U.uRet.value = 0;
  const B = U.uVar.value > .5;
  mastEl.style.transition = B ? 'opacity .45s linear' : '';
  mastEl.style.opacity = B && T > 5.0 && T < 7.5 ? '0' : '';
  U.uLock.value = 0;
  if (T < 0 || T < 3.0 || T >= 18.8 || !A.tGlyph.value) {
    drawMeshes(T >= 1.0 && T < 3.0 ? 'pulse' : 'photo');
    renderer.render(scene, camera);
    return;
  }
  let amt, scr, rev, alpha;
  if (T < 15.1) {
    flight(T, 3.0, 99);                            // burst; the maze (or the particle logo) takes over from here
    U.uMaze.value = B ? cl((T - 3.3) / 1.7) : sm(3.7, 5.0, T);
    U.uLock.value = B ? sm(5.3, 6.2, T) * (1 - sm(7.3, 7.75, T)) : 0;
    U.uSolve.value = -0.05 + 1.15 * cl((T - 4.5) / 2.1);
    const D = B ? 1.2 : 0;
    U.uRet.value = cl((T - 6.7 - D) / 2.2);       // the dots fly home, in order, and settle as the face
    amt = sm(7.6 + D, 8.9 + D, T); scr = 1 - sm(7.9 + D, 11.0 + D, T);
    rev = show.fromH ? 0 : (1 - sm(3.0, 3.55, T)) * 1.08;   // photo leaves cell by cell as the burst starts
    alpha = sm(3.0, 3.12, T) * (1 - sm(9.0 + D, 9.8 + D, T));
    U.uInkMix.value = sm(3.1, 3.9, T);
  } else {
    flight(T, 15.1, 1.4);
    amt = 1 - sm(15.1, 15.8, T); scr = sm(15.1, 15.6, T);
    rev = sm(17.3, 18.5, T) * 1.08;                // photo returns cell by cell under the last particles
    alpha = sm(15.1, 15.25, T) * (1 - sm(17.3, 18.2, T));
    U.uInkMix.value = 1 - sm(16.7, 17.9, T);
  }
  rig.updateMatrixWorld(true); U.uRigWorld.value.copy(rig.matrixWorld);
  // glyph or photo layer
  drawMeshes(amt > 0.001 ? 'ascii' : 'photo');
  renderer.setRenderTarget(rt); renderer.clear(); renderer.render(scene, camera); renderer.setRenderTarget(null);
  A.uAmt.value = amt; A.uScr.value = scr; A.uReveal.value = rev;
  quad.material = asciiMat; renderer.render(qScene, qCam);
  A.uAmt.value = 1; A.uScr.value = 0; A.uReveal.value = 0;
  // particles on top (eyeballs never fly)
  if (alpha > 0) {
    U.uAlpha.value = alpha;
    parts.forEach(p => { p.mesh.visible = false; p.pts.visible = !p.eye; p.pts.material = p.showMat; });
    const ac = renderer.autoClear; renderer.autoClear = false; renderer.clearDepth();
    renderer.render(scene, camera); renderer.autoClear = ac;
  }
}
function frame(t) {
  const now = performance.now();
  const idle = now - st.last > 2600;
  const tx = idle ? Math.sin(t / 2600) * 0.45 : st.look.x;
  const ty = idle ? Math.sin(t / 3700) * 0.25 : st.look.y;
  const k = reduce ? 1 : 0.075;
  st.cur.x += (tx - st.cur.x) * k; st.cur.y += (ty - st.cur.y) * k;
  const yaw = st.cur.x * 0.62 * 0.38 * 0.85, pitch = st.cur.y * 0.26 * 0.38;
  const T = show.on ? (show.paused != null ? show.paused : ((now - show.t0) / 1000) % CYCLE) : -1;
  show.fw += ((T > 0.9 && T < 18.8) || (SCROLL_SIM && (sim.p > .004 || sim.formed)) ? (0 - show.fw) * 0.07 : (1 - show.fw) * 0.07);
  rig.rotation.y = yaw * 0.22 * show.fw;
  pivot.rotation.set(pitch * show.fw, yaw * 0.78 * show.fw, -st.cur.x * 0.04 * show.fw);
  U.uTime.value = reduce ? 4 : t / 1000;

  // how close the pointer is to the head → lens radius
  hb.setFromObject(pivot); hb.getCenter(v); v.project(camera);
  const cr = canvas.getBoundingClientRect();
  const hx = (v.x * 0.5 + 0.5) * W, hy = (-v.y * 0.5 + 0.5) * Hh;
  v.set(hb.max.x, hb.max.y, hb.max.z).project(camera);
  const headR = Math.abs((v.x * 0.5 + 0.5) * W - hx) + 1;
  const mx = st.px - cr.left, my = st.py - cr.top;
  const near = st.seen ? Math.min(1, Math.max(0, 1 - (Math.hypot(mx - hx, my - hy) - headR * 0.55) / (headR * 1.4))) : 0;
  st.lr += (near * headR * fx.lens - st.lr) * (reduce ? 1 : 0.14);
  st.open += (near - st.open) * (reduce ? 1 : 0.08);
  U.uPtr.value.set(mx * dpr, (Hh - my) * dpr, st.lr > 0.8 ? st.lr * dpr : 0);
  U.uOpen.value = st.open;

  if (fx.id === 'pulso' && idle && now - autoT > 3400) { autoT = now; dropRandom(); }
  if (!isShow()) { U.uWaveV.value = 0.11; U.uWaveF.value = 0.6; }
  if (isShow()) { renderShow(now, T); requestAnimationFrame(frame); return; }

  if (fx.id === 'meio-tom' || fx.id === 'ascii') {
    renderer.setRenderTarget(rt); renderer.clear(); renderer.render(scene, camera); renderer.setRenderTarget(null);
    quad.material = fx.id === 'ascii' ? asciiMat : halfMat;
    if (fx.id === 'ascii' && !asciiMat.uniforms.tGlyph.value) { renderer.clear(); }
    else renderer.render(qScene, qCam);
  } else {
    renderer.render(scene, camera);
  }
  requestAnimationFrame(frame);
}

/* ---------- Figma-style cursors in the header ---------- */
(function cursors() {
  const hdr = document.querySelector('.site-header'); if (!hdr) return;
  const nav = hdr.querySelector('.wrap') || hdr;
  const ARROW = '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="M2 1.8 13.8 6.6 8.3 8.3 6.6 13.8Z"/></svg>';
  const mk = (cls, id, html) => { const d = document.createElement(cls === 'mp-sel' ? 'span' : 'div'); d.className = cls === 'mp-sel' ? 'mp-sel' : 'mp ' + cls; d.id = id; d.setAttribute('aria-hidden', 'true'); d.innerHTML = html; nav.appendChild(d); return d; };
  const esc = t => String(t).replace(/[&<>"]/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' })[c]);
  mk('mp-me', 'mpMe', ARROW + '<b>' + esc(CV.me) + '<small>' + esc(CV.say) + '</small></b><i></i>');
  mk('mp-sel', 'mpSel', '');
  mk('mp-you', 'mpYou', ARROW + '<b>' + esc(CV.you) + '</b><i></i>');
  nav.classList.add('mp-host');
  const me = document.getElementById('mpMe'), you = document.getElementById('mpYou'), sel = document.getElementById('mpSel');
  const fine = window.matchMedia('(hover:hover) and (pointer:fine)').matches;
  const R = el => { const r = el.getBoundingClientRect(), n = nav.getBoundingClientRect(); return { x: r.left - n.left, y: r.top - n.top, w: r.width, h: r.height }; };
  const links = () => [...nav.querySelectorAll('.primary-nav a')].filter(el => el.offsetParent && el.getBoundingClientRect().width);
  const talk = nav.querySelector('.header-actions .btn-dark') || nav.querySelector('.header-actions') || nav;
  const rnd = (a, b) => a + Math.random() * (b - a);
  const sleep = ms => new Promise(r => setTimeout(r, ms));
  const pos = { x: R(talk).x - 60, y: 54 };
  let wob = 1;
  // a remote cursor travels on soft curves, eases in and out, and never quite holds still
  function moveTo(x, y, speed = 1) {
    const fx = pos.x, fy = pos.y, dx = x - fx, dy = y - fy, len = Math.hypot(dx, dy) || 1;
    const bend = rnd(-0.28, 0.28) * len, cx = fx + dx / 2 - dy / len * bend, cy = fy + dy / 2 + dx / len * bend;
    const dur = Math.min(1700, 380 + len * 1.15) / speed, t0 = performance.now();
    return new Promise(res => {
      (function step(now) {
        let k = Math.min(1, (now - t0) / dur); k = k < .5 ? 4 * k * k * k : 1 - Math.pow(-2 * k + 2, 3) / 2;
        const u = 1 - k; pos.x = u * u * fx + 2 * u * k * cx + k * k * x; pos.y = u * u * fy + 2 * u * k * cy + k * k * y;
        if (k < 1) requestAnimationFrame(step); else res();
      })(performance.now());
    });
  }
  function click(el) { el.classList.remove('click'); void el.offsetWidth; el.classList.add('click'); setTimeout(() => el.classList.remove('click'), 560); }
  async function say(ms) { me.classList.add('say'); await sleep(ms); me.classList.remove('say'); }
  const acts = {
    async visit() { const l = links(); if (!l.length) return; const r = R(l[(Math.random() * l.length) | 0]); await moveTo(r.x + r.w * rnd(.3, .8), r.y + r.h * rnd(.6, .9)); await sleep(rnd(600, 1300)); },
    async select() { // drag across a menu word, like selecting text in a file
      const l = links(); if (!l.length) return; const r = R(l[(Math.random() * l.length) | 0]);
      await moveTo(r.x - 2, r.y + r.h * .55); await sleep(220);
      sel.style.transform = 'translate(' + (r.x - 3) + 'px,' + (r.y + r.h / 2 - 11) + 'px)'; sel.style.width = '0px'; sel.classList.add('on');
      const t0 = performance.now(), dur = 520 + r.w * 4;
      await new Promise(res => { (function step(now) { const k = Math.min(1, (now - t0) / dur), e = 1 - Math.pow(1 - k, 2);
        pos.x = r.x - 2 + (r.w + 4) * e; sel.style.width = ((r.w + 6) * e) + 'px'; if (k < 1) requestAnimationFrame(step); else res(); })(t0); });
      await sleep(rnd(700, 1100)); sel.classList.remove('on'); await sleep(250);
    },
    async press() { if (!talk.offsetParent) return this.visit(); // circle the button once, then press it
      const r = R(talk), cx = r.x + r.w / 2, cy = r.y + r.h / 2, rx = r.w / 2 + 14, ry = r.h / 2 + 10;
      await moveTo(cx + rx, cy, 1.1);
      const t0 = performance.now(), dur = 1300;
      await new Promise(res => { (function step(now) { const k = Math.min(1, (now - t0) / dur), a = k * Math.PI * 2 * (1 - .12 * k);
        pos.x = cx + Math.cos(a) * rx * (1 - .55 * k); pos.y = cy - Math.sin(a) * ry * (1 - .55 * k); if (k < 1) requestAnimationFrame(step); else res(); })(t0); });
      await sleep(160); click(me); await sleep(rnd(700, 1000));
    },
    async greet() { // drift over to you and wave
      const n = nav.getBoundingClientRect();
      const tx = you.classList.contains('on') ? Math.max(20, Math.min(n.width - 80, ux - 70)) : rnd(n.width * .3, n.width * .6);
      const ty = you.classList.contains('on') ? Math.max(14, Math.min(n.height - 20, uy - 10)) : rnd(20, 50);
      await moveTo(tx, ty, .9);
      // a little two-step wiggle, then the label opens for "hi!"
      for (let i = 0; i < 2; i++) { await moveTo(tx + 7, ty - 3, 3.2); await moveTo(tx - 5, ty + 2, 3.2); }
      await moveTo(tx, ty, 3); await say(1500); await sleep(300);
    },
    async wander() { const n = nav.getBoundingClientRect(); await moveTo(rnd(40, n.width - 120), rnd(18, 56), .8); await sleep(rnd(400, 900)); }
  };
  const plan = ['visit', 'select', 'wander', 'press', 'visit', 'greet', 'visit', 'select', 'wander', 'greet', 'press'];
  let ux = -100, uy = -100, uxs = -100, uys = -100;
  if (fine) {
    hdr.classList.add('has-you');
    hdr.addEventListener('pointermove', e => { const n = nav.getBoundingClientRect(); ux = e.clientX - n.left; uy = e.clientY - n.top; you.classList.add('on'); });
    hdr.addEventListener('pointerleave', () => you.classList.remove('on'));
    hdr.addEventListener('pointerdown', () => click(you));
  }
  function render(now) {
    const wx = Math.sin(now / 410) * .7 + Math.sin(now / 173) * .35, wy = Math.cos(now / 530) * .6;
    me.style.transform = 'translate(' + (pos.x + wx * wob).toFixed(1) + 'px,' + (pos.y + wy * wob).toFixed(1) + 'px)';
    if (uxs < -50) { uxs = ux; uys = uy; }
    uxs += (ux - uxs) * 0.55; uys += (uy - uys) * 0.55;
    you.style.transform = 'translate(' + uxs.toFixed(1) + 'px,' + uys.toFixed(1) + 'px)';
    requestAnimationFrame(render);
  }
  if (reduce) { wob = 0; const r = R(talk); pos.x = r.x - 40; pos.y = r.y + r.h; me.style.transform = 'translate(' + pos.x + 'px,' + pos.y + 'px)'; return; }
  requestAnimationFrame(render);
  (async function life() { let k = 0; await sleep(900); for (;;) { await acts[plan[k++ % plan.length]](); await sleep(rnd(250, 700)); } })();
})();

ready.then(() => { resize(); fromHash(); canvas.classList.add('is-ready'); requestAnimationFrame(frame); });

/* floor grid tilts a touch with the pointer, as on the cover */
const hero = cvRoot, g3 = cvRoot.querySelector('#g3');
hero.addEventListener('pointermove', e => {
  const r = hero.getBoundingClientRect(), x = (e.clientX - r.left) / r.width;
  g3.style.setProperty('--gz', ((x - 0.5) * 3).toFixed(2) + 'deg');
}, { passive: true });
