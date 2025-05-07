function ExecuteScript(strId)
{
  switch (strId)
  {
      case "6MZPTUV1Pau":
        Script1();
        break;
      case "6HlOuEXckqE":
        Script2();
        break;
      case "5aCMVTEUrii":
        Script3();
        break;
      case "5i3uMVPRf3R":
        Script4();
        break;
      case "5oXpcgfaqDs":
        Script5();
        break;
      case "5ZDhZrbLOR1":
        Script6();
        break;
      case "65G3JR4Lwiw":
        Script7();
        break;
      case "6MZXIpVj2Ai":
        Script8();
        break;
      case "6adQt6xb4Uh":
        Script9();
        break;
      case "5b70CcKPNGT":
        Script10();
        break;
      case "5ed4MAbtQyh":
        Script11();
        break;
      case "6DLFt5Er9Li":
        Script12();
        break;
      case "69GZ5Esia1k":
        Script13();
        break;
      case "5d0rbFVslPK":
        Script14();
        break;
      case "6MGqzd20abM":
        Script15();
        break;
      case "6RmdOyMJ3Vy":
        Script16();
        break;
      case "5zkvM7eBArJ":
        Script17();
        break;
      case "5VlY9gLiqEu":
        Script18();
        break;
      case "6RFrcT8Mvtr":
        Script19();
        break;
      case "6ADfnHeX4Ci":
        Script20();
        break;
  }
}

window.InitExecuteScripts = function()
{
var player = GetPlayer();
var object = player.object;
var addToTimeline = player.addToTimeline;
var setVar = player.SetVar;
var getVar = player.GetVar;
window.Script1 = function()
{
  player.once(() => {
const target = object('6LTcCpdr2Jw');
const duration = 750;
const easing = 'ease-out';
const id = '6SSvqn1TsPb';
const pulseAmount = 0.07;
const delay = 750;
addToTimeline(
target.animate([
{ scale: '1' }, { scale: `${1 + pulseAmount}` },
{ scale: '1' }, { scale: `${1 + pulseAmount}` },
{ scale: '1' }
],
  { fill: 'forwards', delay, duration, easing }
), id
);
});
}

window.Script2 = function()
{
  const target = object('6LTcCpdr2Jw');
const duration = 750;
const easing = 'ease-out';
const id = '6SSvqn1TsPb';
const pulseAmount = 0.07;
player.addForTriggers(
id,
target.animate([
{ scale: '1' }, { scale: `${1 + pulseAmount}` },
{ scale: '1' }, { scale: `${1 + pulseAmount}` },
{ scale: '1' }
],
  { fill: 'forwards', duration, easing }
)
);
}

window.Script3 = function()
{
  player.once(() => {
const target = object('6NgwXBlo5AY');
const duration = 4000;
const easing = 'ease-out';
const id = '6CwBs1xXh1C';
const teeterAmount = 2;
const signs = ['-', '', '-'];

const delay = 0;
addToTimeline(
target.animate([
{ rotate: '0deg' },
{ rotate: `${signs[0] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[1] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[2] + teeterAmount}deg` },
{ rotate: '0deg' }
],
  { fill: 'forwards', delay, duration, easing }
), id
);
});
}

window.Script4 = function()
{
  const target = object('6NgwXBlo5AY');
const duration = 4000;
const easing = 'ease-out';
const id = '6CwBs1xXh1C';
const teeterAmount = 2;
const signs = ['-', '', '-'];

player.addForTriggers(
id,
target.animate([
{ rotate: '0deg' },
{ rotate: `${signs[0] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[1] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[2] + teeterAmount}deg` },
{ rotate: '0deg' }
],
  { fill: 'forwards', duration, easing }
)
);
}

window.Script5 = function()
{
  player.once(() => {
const target = object('6B20nIbGFNm');
const duration = 750;
const easing = 'ease-out';
const id = '6nBZhZDVODT';
const pulseAmount = 0.07;
const delay = 1000;
addToTimeline(
target.animate([
{ scale: '1' }, { scale: `${1 + pulseAmount}` },
{ scale: '1' }, { scale: `${1 + pulseAmount}` },
{ scale: '1' }
],
  { fill: 'forwards', delay, duration, easing }
), id
);
});
}

window.Script6 = function()
{
  const target = object('6B20nIbGFNm');
const duration = 750;
const easing = 'ease-out';
const id = '6nBZhZDVODT';
const pulseAmount = 0.07;
player.addForTriggers(
id,
target.animate([
{ scale: '1' }, { scale: `${1 + pulseAmount}` },
{ scale: '1' }, { scale: `${1 + pulseAmount}` },
{ scale: '1' }
],
  { fill: 'forwards', duration, easing }
)
);
}

window.Script7 = function()
{
  player.once(() => {
const target = object('6pNgaKqdtsy');
const duration = 4000;
const easing = 'ease-out';
const id = '6pfmjkpQLiB';
const teeterAmount = 2;
const signs = ['', '-', ''];

const delay = 0;
addToTimeline(
target.animate([
{ rotate: '0deg' },
{ rotate: `${signs[0] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[1] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[2] + teeterAmount}deg` },
{ rotate: '0deg' }
],
  { fill: 'forwards', delay, duration, easing }
), id
);
});
}

window.Script8 = function()
{
  const target = object('6pNgaKqdtsy');
const duration = 4000;
const easing = 'ease-out';
const id = '6pfmjkpQLiB';
const teeterAmount = 2;
const signs = ['', '-', ''];

player.addForTriggers(
id,
target.animate([
{ rotate: '0deg' },
{ rotate: `${signs[0] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[1] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[2] + teeterAmount}deg` },
{ rotate: '0deg' }
],
  { fill: 'forwards', duration, easing }
)
);
}

window.Script9 = function()
{
  player.once(() => {
const target = object('62rt7FflvJm');
const duration = 500;
const easing = 'ease-out';
const id = '5wgBMl4iY8P';
const shakeAmount = 1;
const delay = 250;
addToTimeline(
target.animate([
{ translate: '0 0' },
{ translate: `-${shakeAmount}px 0` },
{ translate: '0 0' },
{ translate: `${shakeAmount}px 0` },
{ translate: '0 0' },
{ translate: `-${shakeAmount}px 0` },
{ translate: '0 0' }
],
  { fill: 'forwards', delay, duration, easing }
), id
);
});
}

window.Script10 = function()
{
  const target = object('62rt7FflvJm');
const duration = 500;
const easing = 'ease-out';
const id = '5wgBMl4iY8P';
const shakeAmount = 1;
player.addForTriggers(
id,
target.animate([
{ translate: '0 0' },
{ translate: `-${shakeAmount}px 0` },
{ translate: '0 0' },
{ translate: `${shakeAmount}px 0` },
{ translate: '0 0' },
{ translate: `-${shakeAmount}px 0` },
{ translate: '0 0' }
],
  { fill: 'forwards', duration, easing }
)
);
}

window.Script11 = function()
{
  player.once(() => {
const target = object('5W6OZ7Q6yID');
const duration = 4000;
const easing = 'ease-out';
const id = '64eFp0aUkeQ';
const teeterAmount = 2;
const signs = ['-', '', '-'];

const delay = 0;
addToTimeline(
target.animate([
{ rotate: '0deg' },
{ rotate: `${signs[0] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[1] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[2] + teeterAmount}deg` },
{ rotate: '0deg' }
],
  { fill: 'forwards', delay, duration, easing }
), id
);
});
}

window.Script12 = function()
{
  const target = object('5W6OZ7Q6yID');
const duration = 4000;
const easing = 'ease-out';
const id = '64eFp0aUkeQ';
const teeterAmount = 2;
const signs = ['-', '', '-'];

player.addForTriggers(
id,
target.animate([
{ rotate: '0deg' },
{ rotate: `${signs[0] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[1] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[2] + teeterAmount}deg` },
{ rotate: '0deg' }
],
  { fill: 'forwards', duration, easing }
)
);
}

window.Script13 = function()
{
  player.once(() => {
const target = object('6Mn18HWPhrK');
const duration = 4000;
const easing = 'ease-out';
const id = '6KbvhNUZkFt';
const teeterAmount = 2;
const signs = ['-', '', '-'];

const delay = 0;
addToTimeline(
target.animate([
{ rotate: '0deg' },
{ rotate: `${signs[0] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[1] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[2] + teeterAmount}deg` },
{ rotate: '0deg' }
],
  { fill: 'forwards', delay, duration, easing }
), id
);
});
}

window.Script14 = function()
{
  const target = object('6Mn18HWPhrK');
const duration = 4000;
const easing = 'ease-out';
const id = '6KbvhNUZkFt';
const teeterAmount = 2;
const signs = ['-', '', '-'];

player.addForTriggers(
id,
target.animate([
{ rotate: '0deg' },
{ rotate: `${signs[0] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[1] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[2] + teeterAmount}deg` },
{ rotate: '0deg' }
],
  { fill: 'forwards', duration, easing }
)
);
}

window.Script15 = function()
{
  player.once(() => {
const target = object('5gQsqNjTQkE');
const duration = 750;
const easing = 'ease-out';
const id = '5yluXrLSuJd';
const pulseAmount = 0.07;
const delay = 0;
addToTimeline(
target.animate([
{ scale: '1' }, { scale: `${1 + pulseAmount}` },
{ scale: '1' }, { scale: `${1 + pulseAmount}` },
{ scale: '1' }
],
  { fill: 'forwards', delay, duration, easing }
), id
);
});
}

window.Script16 = function()
{
  const target = object('5gQsqNjTQkE');
const duration = 750;
const easing = 'ease-out';
const id = '5yluXrLSuJd';
const pulseAmount = 0.07;
player.addForTriggers(
id,
target.animate([
{ scale: '1' }, { scale: `${1 + pulseAmount}` },
{ scale: '1' }, { scale: `${1 + pulseAmount}` },
{ scale: '1' }
],
  { fill: 'forwards', duration, easing }
)
);
}

window.Script17 = function()
{
  player.once(() => {
const target = object('6i5hkKX3Bbh');
const duration = 4000;
const easing = 'ease-out';
const id = '5YbfjhydDc7';
const teeterAmount = 2;
const signs = ['', '-', ''];

const delay = 2125;
addToTimeline(
target.animate([
{ rotate: '0deg' },
{ rotate: `${signs[0] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[1] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[2] + teeterAmount}deg` },
{ rotate: '0deg' }
],
  { fill: 'forwards', delay, duration, easing }
), id
);
});
}

window.Script18 = function()
{
  const target = object('6i5hkKX3Bbh');
const duration = 4000;
const easing = 'ease-out';
const id = '5YbfjhydDc7';
const teeterAmount = 2;
const signs = ['', '-', ''];

player.addForTriggers(
id,
target.animate([
{ rotate: '0deg' },
{ rotate: `${signs[0] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[1] + teeterAmount}deg` },
{ rotate: '0deg' },
{ rotate: `${signs[2] + teeterAmount}deg` },
{ rotate: '0deg' }
],
  { fill: 'forwards', duration, easing }
)
);
}

window.Script19 = function()
{
  player.once(() => {
const target = object('5flWJ2rE8sl');
const duration = 500;
const easing = 'ease-out';
const id = '6j7Wh7kLWFz';
const shakeAmount = 1;
const delay = 2375;
addToTimeline(
target.animate([
{ translate: '0 0' },
{ translate: `-${shakeAmount}px 0` },
{ translate: '0 0' },
{ translate: `${shakeAmount}px 0` },
{ translate: '0 0' },
{ translate: `-${shakeAmount}px 0` },
{ translate: '0 0' }
],
  { fill: 'forwards', delay, duration, easing }
), id
);
});
}

window.Script20 = function()
{
  const target = object('5flWJ2rE8sl');
const duration = 500;
const easing = 'ease-out';
const id = '6j7Wh7kLWFz';
const shakeAmount = 1;
player.addForTriggers(
id,
target.animate([
{ translate: '0 0' },
{ translate: `-${shakeAmount}px 0` },
{ translate: '0 0' },
{ translate: `${shakeAmount}px 0` },
{ translate: '0 0' },
{ translate: `-${shakeAmount}px 0` },
{ translate: '0 0' }
],
  { fill: 'forwards', duration, easing }
)
);
}

};
