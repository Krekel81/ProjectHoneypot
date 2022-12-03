"use strict";

document.addEventListener('DOMContentLoaded', init);

function init()
{
    setTimeout (console.log.bind (console, "%cStop searching for what you shall not find!", "font-weight: bold; font-size: 0.8rem;color: red; padding: 1rem;"));

    if (location.protocol !== 'https:') {
        location.replace(`https:${location.href.substring(location.protocol.length)}`);
    }

    document.querySelectorAll("#challengeList button").forEach((element, index) => {
        const page = "challenge" + (index+1);
        element.addEventListener('click', () => redirectHTML(page));
    });

}
