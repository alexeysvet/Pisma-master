var Pisma = function (config) {
	config = config || {};
	Pisma.superclass.constructor.call(this, config);
};
Ext.extend(Pisma, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('pisma', Pisma);

Pisma = new Pisma();