"use strict";

document.addEventListener('DOMContentLoaded', init);

function init()
{
    setTimeout (console.log.bind (console, "%cStop searching for what you shall not find!", "font-weight: bold; font-size: 0.8rem;color: red; padding: 1rem;"));
    /* ALS JE LIVE SERVER WILT GEBRUIKEN ZET DIT IN COMMENTS */
/*
    if (location.protocol !== 'https:' && location.protocol !== localhost ) {
        location.replace(`https:${location.href.substring(location.protocol.length)}`);
    }
*/
    document.querySelectorAll("#challengeList button").forEach((element, index) => {
        const page = "challenge" + (index+1) + ".html";
        element.addEventListener('click', () => redirectHTML(page));
    });
}

function redirectHTML(page)
{
    window.location.href = page;
}