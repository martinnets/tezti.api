function ExecuteScript(strId)
{
  switch (strId)
  {
      case "6mXWwyzJbmw":
        Script1();
        break;
      case "6R6t7TXUMlE":
        Script2();
        break;
      case "63FlLZQ9EwN":
        Script3();
        break;
      case "5mgEDOLvgDJ":
        Script4();
        break;
      case "5m5g1ibsd6R":
        Script5();
        break;
      case "5mAvjuIpAqq":
        Script6();
        break;
  }
}

window.InitExecuteScripts = function()
{
var player = GetPlayer();
var object = player.object;
var once = player.once;
var addToTimeline = player.addToTimeline;
var setVar = player.SetVar;
var getVar = player.GetVar;
window.Script1 = function()
{
  player.once(() => {
const target = object('5zlVcX7GbBe');
const duration = 5250;
const easing = 'ease-out';
const id = '6F0vMxGXCC0';
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
  const target = object('5zlVcX7GbBe');
const duration = 5250;
const easing = 'ease-out';
const id = '6F0vMxGXCC0';
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
const target = object('5do07aXohbF');
const duration = 750;
const easing = 'ease-out';
const id = '6SuvCxpYFwF';
const pulseAmount = 0.07;
const delay = 1500;
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
  const target = object('5do07aXohbF');
const duration = 750;
const easing = 'ease-out';
const id = '6SuvCxpYFwF';
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
const target = object('5cLuKhNSqK3');
const duration = 750;
const easing = 'ease-out';
const id = '67bRKShos5v';
const pulseAmount = 0.07;
const delay = 2750;
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
  const target = object('5cLuKhNSqK3');
const duration = 750;
const easing = 'ease-out';
const id = '67bRKShos5v';
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
