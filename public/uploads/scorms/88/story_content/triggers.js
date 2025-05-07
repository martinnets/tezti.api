function ExecuteScript(strId)
{
  switch (strId)
  {
      case "6fxrkiCOci3":
        Script1();
        break;
      case "6HkMvhWPEsA":
        Script2();
        break;
      case "6YY3gTRaaqn":
        Script3();
        break;
      case "6OBGZjtyK7a":
        Script4();
        break;
      case "5ZJDwk91RRM":
        Script5();
        break;
      case "5W2VSVCq014":
        Script6();
        break;
      case "5luBEJeygK3":
        Script7();
        break;
      case "6ImUI5pcaBt":
        Script8();
        break;
      case "5jgqjnok54z":
        Script9();
        break;
      case "6j2L5VdlDnG":
        Script10();
        break;
      case "5wQlWx3Vrri":
        Script11();
        break;
      case "6X9YpwOj94n":
        Script12();
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
const target = object('6OAQJuLFA6V');
const duration = 750;
const easing = 'ease-out';
const id = '619UuNthfPH';
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

window.Script2 = function()
{
  const target = object('6OAQJuLFA6V');
const duration = 750;
const easing = 'ease-out';
const id = '619UuNthfPH';
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
const target = object('683GRCRdly4');
const duration = 4000;
const easing = 'ease-out';
const id = '6U3JYR8sBoA';
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

window.Script4 = function()
{
  const target = object('683GRCRdly4');
const duration = 4000;
const easing = 'ease-out';
const id = '6U3JYR8sBoA';
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

window.Script5 = function()
{
  player.once(() => {
const target = object('6LxLkY81dDs');
const duration = 3250;
const easing = 'ease-out';
const id = '6oGLCIx58I2';
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
  const target = object('6LxLkY81dDs');
const duration = 3250;
const easing = 'ease-out';
const id = '6oGLCIx58I2';
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
const target = object('6MkxJUm5i9n');
const duration = 3750;
const easing = 'ease-out';
const id = '5YB8M6rNys7';
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
  const target = object('6MkxJUm5i9n');
const duration = 3750;
const easing = 'ease-out';
const id = '5YB8M6rNys7';
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
const target = object('5wiYiMUYs7f');
const duration = 6000;
const easing = 'ease-out';
const id = '6J824EK0HL6';
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

window.Script10 = function()
{
  const target = object('5wiYiMUYs7f');
const duration = 6000;
const easing = 'ease-out';
const id = '6J824EK0HL6';
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

window.Script11 = function()
{
  player.once(() => {
const target = object('5XCkoQNRkRR');
const duration = 750;
const easing = 'ease-out';
const id = '619UuNthfPH';
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

window.Script12 = function()
{
  const target = object('5XCkoQNRkRR');
const duration = 750;
const easing = 'ease-out';
const id = '619UuNthfPH';
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
