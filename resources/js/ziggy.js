const Ziggy = {"url":"http:\/\/192.168.10.127","port":null,"defaults":{},"routes":{"duinput.create":{"uri":"duinput","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
