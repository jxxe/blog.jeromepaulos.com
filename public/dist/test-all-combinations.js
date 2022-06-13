const adjectives = ['freezing', 'frigid', 'cold', 'chilly', 'pleasant', 'warm', 'hot', 'blistering', 'scorching', 'blustery'];
const seasons = ['spring', 'summer', 'fall', 'winter'];
const times = ['morning', 'day', /*'afternoon',*/ 'evening', 'night'];

const title = document.querySelector('#header span');
const html = document.querySelector('html');

let combinations = [];

adjectives.forEach(adjective => {
    seasons.forEach(season => {
        times.forEach(time => {
            combinations.push(`${adjective} ${season} ${time}`);
        });
    });
});

let index = 0;

setInterval(() => {
    const string = combinations[index++ % combinations.length];
    title.innerHTML = `<span>It's a ${string} in <abbr title="I'm currently in Saint Paul, Minnesota">St Paul</abbr></span>`;
    html.dataset.ambiance = string;
}, 250);