function ExecuteScript(strId)
{
  switch (strId)
  {
      case "66QLLOqWosg":
        Script1();
        break;
      case "5yOoMxDEPNx":
        Script2();
        break;
      case "6Webo36QFf5":
        Script3();
        break;
      case "6FZ6GEddJj0":
        Script4();
        break;
      case "6MwoSGapexv":
        Script5();
        break;
      case "6XELNgvzLLZ":
        Script6();
        break;
      case "5jSrYdO9cyy":
        Script7();
        break;
      case "5crWEGASi0v":
        Script8();
        break;
      case "67o5QIemeeW":
        Script9();
        break;
      case "6iE1O4BYLwI":
        Script10();
        break;
      case "5uzLFeUgJn3":
        Script11();
        break;
      case "6AxcRuUnAic":
        Script12();
        break;
      case "600l8iDLV5T":
        Script13();
        break;
      case "6FJ4LGw67ue":
        Script14();
        break;
      case "5mWxMs9805W":
        Script15();
        break;
      case "5vOPtYKg9Kb":
        Script16();
        break;
      case "5jwjvnfdKG4":
        Script17();
        break;
      case "5WH287SygEU":
        Script18();
        break;
      case "6gAHxmVTpcS":
        Script19();
        break;
      case "6ItSa0sOCPg":
        Script20();
        break;
      case "6qJ8PLrXEhT":
        Script21();
        break;
      case "5aaQ677mNWr":
        Script22();
        break;
      case "6EOUzpOpiFE":
        Script23();
        break;
      case "6bBv73n1h2l":
        Script24();
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
const target = object('6EYIJUBveIh');
const duration = 5250;
const easing = 'ease-out';
const id = '6G1zKHyuFIw';
const teeterAmount = 4;
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

window.Script2 = function()
{
  const target = object('6EYIJUBveIh');
const duration = 5250;
const easing = 'ease-out';
const id = '6G1zKHyuFIw';
const teeterAmount = 4;
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

window.Script3 = function()
{
  player.once(() => {
const target = object('5cvV4rbTp86');
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

window.Script4 = function()
{
  const target = object('5cvV4rbTp86');
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

window.Script5 = function()
{
  player.once(() => {
const target = object('6iw732tMLwr');
const duration = 2500;
const easing = 'ease-out';
const id = '5Wg70YmK4JL';
const teeterAmount = 4;
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

window.Script6 = function()
{
  const target = object('6iw732tMLwr');
const duration = 2500;
const easing = 'ease-out';
const id = '5Wg70YmK4JL';
const teeterAmount = 4;
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

window.Script7 = function()
{
  player.once(() => {
const target = object('5tj7Qo6KVoV');
const duration = 2500;
const easing = 'ease-out';
const id = '5pM48TJ23xY';
const teeterAmount = 4;
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

window.Script8 = function()
{
  const target = object('5tj7Qo6KVoV');
const duration = 2500;
const easing = 'ease-out';
const id = '5pM48TJ23xY';
const teeterAmount = 4;
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

window.Script9 = function()
{
  player.once(() => {
const target = object('5ubvwHUxOI5');
const duration = 5250;
const easing = 'ease-out';
const id = '6NCr6oohlmq';
const teeterAmount = 4;
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

window.Script10 = function()
{
  const target = object('5ubvwHUxOI5');
const duration = 5250;
const easing = 'ease-out';
const id = '6NCr6oohlmq';
const teeterAmount = 4;
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

window.Script11 = function()
{
  player.once(() => {
const target = object('6ohAj7uW2S9');
const duration = 1250;
const easing = 'ease-out';
const id = '63HantiOviU';
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

window.Script12 = function()
{
  const target = object('6ohAj7uW2S9');
const duration = 1250;
const easing = 'ease-out';
const id = '63HantiOviU';
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

window.Script13 = function()
{
  player.once(() => {
const target = object('6JWYwwNU65Z');
const duration = 1750;
const easing = 'ease-out';
const id = '5oVMtENZtpp';
const shakeAmount = 1;
const delay = 500;
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

window.Script14 = function()
{
  const target = object('6JWYwwNU65Z');
const duration = 1750;
const easing = 'ease-out';
const id = '5oVMtENZtpp';
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

window.Script15 = function()
{
  player.once(() => {
const target = object('6hp3hBfbVfe');
const duration = 2250;
const easing = 'ease-out';
const id = '5tUsbcdiIsD';
const shakeAmount = 1;
const delay = 750;
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

window.Script16 = function()
{
  const target = object('6hp3hBfbVfe');
const duration = 2250;
const easing = 'ease-out';
const id = '5tUsbcdiIsD';
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

window.Script17 = function()
{
  player.once(() => {
const target = object('5niImE6c77G');
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

window.Script18 = function()
{
  const target = object('5niImE6c77G');
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

window.Script19 = function()
{
  player.once(() => {
const target = object('63NRaJsyS6y');
const duration = 1250;
const easing = 'ease-out';
const id = '6lhIPEcbyIl';
const shakeAmount = 1;
const delay = 1125;
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
  const target = object('63NRaJsyS6y');
const duration = 1250;
const easing = 'ease-out';
const id = '6lhIPEcbyIl';
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

window.Script21 = function()
{
  player.once(() => {
const target = object('6LOBmvastU7');
const duration = 1750;
const easing = 'ease-out';
const id = '5mKtcZA9eF1';
const shakeAmount = 1;
const delay = 1375;
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

window.Script22 = function()
{
  const target = object('6LOBmvastU7');
const duration = 1750;
const easing = 'ease-out';
const id = '5mKtcZA9eF1';
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

window.Script23 = function()
{
  player.once(() => {
const target = object('6Lt3RLSUtgf');
const duration = 2250;
const easing = 'ease-out';
const id = '6ok0SAlUcGL';
const shakeAmount = 1;
const delay = 1625;
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

window.Script24 = function()
{
  const target = object('6Lt3RLSUtgf');
const duration = 2250;
const easing = 'ease-out';
const id = '6ok0SAlUcGL';
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
