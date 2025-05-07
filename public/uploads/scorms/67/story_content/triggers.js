function ExecuteScript(strId)
{
  switch (strId)
  {
      case "6ipmUrLt9uy":
        Script1();
        break;
      case "5lZOMSRVD1g":
        Script2();
        break;
      case "5deJ6ddWxIs":
        Script3();
        break;
      case "62j4u5YloyR":
        Script4();
        break;
      case "5dLw3NkzgzA":
        Script5();
        break;
      case "5t2DRio1PcP":
        Script6();
        break;
      case "5hjePESwCcW":
        Script7();
        break;
      case "6m05OhbPafp":
        Script8();
        break;
      case "6iV7mHPKPl4":
        Script9();
        break;
      case "60AUGB5GFF5":
        Script10();
        break;
      case "6lMVrCREECe":
        Script11();
        break;
      case "6TzwPpZtUVJ":
        Script12();
        break;
      case "6g2chwEY7JI":
        Script13();
        break;
      case "67JHsQA27Bp":
        Script14();
        break;
      case "6nmYPKPDxXo":
        Script15();
        break;
      case "6j0XiR33V89":
        Script16();
        break;
      case "6T5Hb5Ql28j":
        Script17();
        break;
      case "6LcBOk963Bi":
        Script18();
        break;
      case "6Aie9tN8dhS":
        Script19();
        break;
      case "6hYgVXMyTn9":
        Script20();
        break;
      case "5fjewEeQCUW":
        Script21();
        break;
      case "5VF1u48RauJ":
        Script22();
        break;
      case "5hrHY0ibZrI":
        Script23();
        break;
      case "6Snme8jLtEg":
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
const target = object('6ponsP11Q5l');
const duration = 3500;
const easing = 'ease-out';
const id = '5pCfF7UjDHg';
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

window.Script2 = function()
{
  const target = object('6ponsP11Q5l');
const duration = 3500;
const easing = 'ease-out';
const id = '5pCfF7UjDHg';
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

window.Script3 = function()
{
  player.once(() => {
const target = object('6DkZNUhfKSi');
const duration = 4250;
const easing = 'ease-out';
const id = '5YEY5UYwKJO';
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
  const target = object('6DkZNUhfKSi');
const duration = 4250;
const easing = 'ease-out';
const id = '5YEY5UYwKJO';
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
const target = object('6daHyJLGVYz');
const duration = 4250;
const easing = 'ease-out';
const id = '63DpMO3aYKV';
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

window.Script6 = function()
{
  const target = object('6daHyJLGVYz');
const duration = 4250;
const easing = 'ease-out';
const id = '63DpMO3aYKV';
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
const target = object('6ViZE3l5kAo');
const duration = 750;
const easing = 'ease-out';
const id = '5gagSH6eKp3';
const shakeAmount = 5;
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

window.Script8 = function()
{
  const target = object('6ViZE3l5kAo');
const duration = 750;
const easing = 'ease-out';
const id = '5gagSH6eKp3';
const shakeAmount = 5;
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
const target = object('5zGURKAEJqt');
const duration = 1750;
const easing = 'ease-out';
const id = '6mZBej91aV5';
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

window.Script10 = function()
{
  const target = object('5zGURKAEJqt');
const duration = 1750;
const easing = 'ease-out';
const id = '6mZBej91aV5';
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

window.Script11 = function()
{
  player.once(() => {
const target = object('5sGrQONO7hh');
const duration = 1750;
const easing = 'ease-out';
const id = '6HaoOJVnqLm';
const pulseAmount = 0.07;
const delay = 250;
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
  const target = object('5sGrQONO7hh');
const duration = 1750;
const easing = 'ease-out';
const id = '6HaoOJVnqLm';
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

window.Script13 = function()
{
  player.once(() => {
const target = object('6ihRo0T8mUi');
const duration = 1750;
const easing = 'ease-out';
const id = '6qO88QW6Jbm';
const pulseAmount = 0.07;
const delay = 500;
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
  const target = object('6ihRo0T8mUi');
const duration = 1750;
const easing = 'ease-out';
const id = '6qO88QW6Jbm';
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

window.Script15 = function()
{
  player.once(() => {
const target = object('5coTXXshMa5');
const duration = 1750;
const easing = 'ease-out';
const id = '6cUBFnoFz9a';
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

window.Script16 = function()
{
  const target = object('5coTXXshMa5');
const duration = 1750;
const easing = 'ease-out';
const id = '6cUBFnoFz9a';
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
const target = object('6ZtIQuMsFEN');
const duration = 1750;
const easing = 'ease-out';
const id = '6pzk1Vk2tIH';
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

window.Script18 = function()
{
  const target = object('6ZtIQuMsFEN');
const duration = 1750;
const easing = 'ease-out';
const id = '6pzk1Vk2tIH';
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
const target = object('6EdOpW7pkps');
const duration = 1750;
const easing = 'ease-out';
const id = '6eGV8MJIKD9';
const pulseAmount = 0.07;
const delay = 1250;
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

window.Script20 = function()
{
  const target = object('6EdOpW7pkps');
const duration = 1750;
const easing = 'ease-out';
const id = '6eGV8MJIKD9';
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

window.Script21 = function()
{
  player.once(() => {
const target = object('6p9ZPAQujWa');
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

window.Script22 = function()
{
  const target = object('6p9ZPAQujWa');
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

window.Script23 = function()
{
  player.once(() => {
const target = object('5cVn2VdaEcU');
const duration = 1750;
const easing = 'ease-out';
const id = '6mUN9zVyzo0';
const pulseAmount = 0.07;
const delay = 1750;
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

window.Script24 = function()
{
  const target = object('5cVn2VdaEcU');
const duration = 1750;
const easing = 'ease-out';
const id = '6mUN9zVyzo0';
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

};
