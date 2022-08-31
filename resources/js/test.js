console.log('yo');
window.Echo.channel(`chat`).error(e=>{
    console.log(e);
}).listen('.send', (e)=>{
    console.log(e.message);
});
