function ExecuteScript(strId)
{
  switch (strId)
  {
      case "5beppHlCJ9I":
        Script1();
        break;
      case "5bAi3L6t8I9":
        Script2();
        break;
      case "6chPNlnSHHh":
        Script3();
        break;
      case "6JgqcOezTCS":
        Script4();
        break;
      case "63DfuZvLUkg":
        Script5();
        break;
      case "6FSEndeNDV3":
        Script6();
        break;
      case "5gqicYAc5ig":
        Script7();
        break;
      case "6nhoPaW82i9":
        Script8();
        break;
      case "64PEs26uu4E":
        Script9();
        break;
      case "5XGmgENC4MR":
        Script10();
        break;
      case "6NwtpsxVkZ9":
        Script11();
        break;
      case "6QvS3sl0WXm":
        Script12();
        break;
      case "6MYRfv7hHqt":
        Script13();
        break;
      case "6eRIrC1FklD":
        Script14();
        break;
      case "6lZGg5WA0k1":
        Script15();
        break;
      case "5oENMkIQ9u4":
        Script16();
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
const target = object('6ro7r8RO53Z');
const duration = 4500;
const easing = 'ease-out';
const id = '6a7hzFI1yjz';
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

window.Script2 = function()
{
  const target = object('6ro7r8RO53Z');
const duration = 4500;
const easing = 'ease-out';
const id = '6a7hzFI1yjz';
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

window.Script3 = function()
{
  player.once(() => {
const target = object('6oedmcY3JMy');
const duration = 4500;
const easing = 'ease-out';
const id = '6eUrb2UrR1f';
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

window.Script4 = function()
{
  const target = object('6oedmcY3JMy');
const duration = 4500;
const easing = 'ease-out';
const id = '6eUrb2UrR1f';
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

window.Script5 = function()
{
  player.once(() => {
const target = object('6UZhp6HPxKS');
const duration = 2750;
const easing = 'ease-out';
const id = '6Mvasdf9Fnv';
const teeterAmount = 2;
const signs = ['-', '', '-'];

const delay = 4500;
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
  const target = object('6UZhp6HPxKS');
const duration = 2750;
const easing = 'ease-out';
const id = '6Mvasdf9Fnv';
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

window.Script7 = function()
{
  player.once(() => {
const target = object('6YW8iXrauqU');
const duration = 750;
const easing = 'ease-out';
const id = '6RRkQf8dwiE';
const shakeAmount = 1;
const delay = 4750;
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

window.Script8 = function()
{
  const target = object('6YW8iXrauqU');
const duration = 750;
const easing = 'ease-out';
const id = '6RRkQf8dwiE';
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

window.Script9 = function()
{
  player.once(() => {
const target = object('5x5OQUKjrYg');
const duration = 750;
const easing = 'ease-out';
const id = '6AHj0sp37aR';
const shakeAmount = 1;
const delay = 4750;
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
  const target = object('5x5OQUKjrYg');
const duration = 750;
const easing = 'ease-out';
const id = '6AHj0sp37aR';
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
const target = object('6fJ9K1WU2hb');
const duration = 4750;
const easing = 'ease-out';
const id = '6ZCqHgbGcXp';
const pulseAmount = 0.03;
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

window.Script12 = function()
{
  const target = object('6fJ9K1WU2hb');
const duration = 4750;
const easing = 'ease-out';
const id = '6ZCqHgbGcXp';
const pulseAmount = 0.03;
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

window.Script13 = function()
{
  player.once(() => {
const target = object('5zdI2YeZQcz');
const duration = 4750;
const easing = 'ease-out';
const id = '6SROmfOcT0i';
const pulseAmount = 0.03;
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

window.Script14 = function()
{
  const target = object('5zdI2YeZQcz');
const duration = 4750;
const easing = 'ease-out';
const id = '6SROmfOcT0i';
const pulseAmount = 0.03;
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

window.Script15 = function()
{
  player.once(() => {
const target = object('5WGQ8Zud0i0');
const duration = 500;
const easing = 'ease-out';
const id = '6C0Lr1yyq0D';
const shakeAmount = 1;
const delay = 1000;
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
  const target = object('5WGQ8Zud0i0');
const duration = 500;
const easing = 'ease-out';
const id = '6C0Lr1yyq0D';
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
