/*
 Highstock JS v8.0.1 (2020-03-02)

 Advanced Highstock tools

 (c) 2010-2019 Highsoft AS
 Author: Torstein Honsi

 License: www.highcharts.com/license
*/
(function(f){"object"===typeof module&&module.exports?(f["default"]=f,module.exports=f):"function"===typeof define&&define.amd?define("highcharts/modules/stock-tools",["highcharts","highcharts/modules/stock"],function(t){f(t);f.Highcharts=t;return f}):f("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(f){function t(q,g,l,f){q.hasOwnProperty(g)||(q[g]=f.apply(null,l))}f=f?f._modules:{};t(f,"modules/stock-tools-bindings.js",[f["parts/Globals.js"],f["parts/Utilities.js"]],function(q,g){var l=
g.correctFloat,f=g.defined,t=g.extend,x=g.isNumber,h=g.merge,u=g.pick,w=g.uniqueKey,m=q.fireEvent,c=q.NavigationBindings.prototype.utils;c.addFlagFromForm=function(a){return function(b){var d=this,e=d.chart,k=e.stockTools,p=c.getFieldType;b=c.attractToPoint(b,e);var r={type:"flags",onSeries:b.series.id,shape:a,data:[{x:b.x,y:b.y}],point:{events:{click:function(){var a=this,b=a.options;m(d,"showPopup",{point:a,formType:"annotation-toolbar",options:{langKey:"flags",type:"flags",title:[b.title,p(b.title)],
name:[b.name,p(b.name)]},onSubmit:function(b){"remove"===b.actionType?a.remove():a.update(d.fieldsToOptions(b.fields,{}))}})}}}};k&&k.guiEnabled||e.addSeries(r);m(d,"showPopup",{formType:"flag",options:{langKey:"flags",type:"flags",title:["A",p("A")],name:["Flag A",p("Flag A")]},onSubmit:function(a){d.fieldsToOptions(a.fields,r.data[0]);e.addSeries(r)}})}};c.manageIndicators=function(a){var b=this.chart,d={linkedTo:a.linkedTo,type:a.type},e=["ad","cmf","mfi","vbp","vwap"],k="ad atr cci cmf macd mfi roc rsi ao aroon aroonoscillator trix apo dpo ppo natr williamsr stochastic slowstochastic linearRegression linearRegressionSlope linearRegressionIntercept linearRegressionAngle".split(" ");
if("edit"===a.actionType)this.fieldsToOptions(a.fields,d),(a=b.get(a.seriesId))&&a.update(d,!1);else if("remove"===a.actionType){if(a=b.get(a.seriesId)){var p=a.yAxis;a.linkedSeries&&a.linkedSeries.forEach(function(a){a.remove(!1)});a.remove(!1);0<=k.indexOf(a.type)&&(p.remove(!1),this.resizeYAxes())}}else d.id=w(),this.fieldsToOptions(a.fields,d),0<=k.indexOf(a.type)?(p=b.addAxis({id:w(),offset:0,opposite:!0,title:{text:""},tickPixelInterval:40,showLastLabel:!1,labels:{align:"left",y:-2}},!1,!1),
d.yAxis=p.options.id,this.resizeYAxes()):d.yAxis=b.get(a.linkedTo).options.yAxis,0<=e.indexOf(a.type)&&(d.params.volumeSeriesID=b.series.filter(function(a){return"column"===a.options.type})[0].options.id),b.addSeries(d,!1);m(this,"deselectButton",{button:this.selectedButtonElement});b.redraw()};c.updateHeight=function(a,b){b.update({typeOptions:{height:this.chart.pointer.getCoordinates(a).yAxis[0].value-b.options.typeOptions.points[1].y}})};c.attractToPoint=function(a,b){a=b.pointer.getCoordinates(a);
var d=a.xAxis[0].value;a=a.yAxis[0].value;var e=Number.MAX_VALUE,k;b.series.forEach(function(a){a.points.forEach(function(a){a&&e>Math.abs(a.x-d)&&(e=Math.abs(a.x-d),k=a)})});return{x:k.x,y:k.y,below:a<k.y,series:k.series,xAxis:k.series.xAxis.index||0,yAxis:k.series.yAxis.index||0}};c.isNotNavigatorYAxis=function(a){return"highcharts-navigator-yaxis"!==a.userOptions.className};c.updateNthPoint=function(a){return function(b,d){var e=d.options.typeOptions;b=this.chart.pointer.getCoordinates(b);var k=
b.xAxis[0].value,p=b.yAxis[0].value;e.points.forEach(function(b,e){e>=a&&(b.x=k,b.y=p)});d.update({typeOptions:{points:e.points}})}};t(q.NavigationBindings.prototype,{getYAxisPositions:function(a,b,d){function e(a){return f(a)&&!x(a)&&a.match("%")}var k=0;a=a.map(function(a){var c=e(a.options.height)?parseFloat(a.options.height)/100:a.height/b;a=e(a.options.top)?parseFloat(a.options.top)/100:l(a.top-a.chart.plotTop)/b;x(c)||(c=d/100);k=l(k+c);return{height:100*c,top:100*a}});a.allAxesHeight=k;return a},
getYAxisResizers:function(a){var b=[];a.forEach(function(d,e){d=a[e+1];b[e]=d?{enabled:!0,controlledAxis:{next:[u(d.options.id,d.options.index)]}}:{enabled:!1}});return b},resizeYAxes:function(a){a=a||20;var b=this.chart,d=b.yAxis.filter(this.utils.isNotNavigatorYAxis),e=d.length;b=this.getYAxisPositions(d,b.plotHeight,a);var k=this.getYAxisResizers(d),c=b.allAxesHeight,r=a;1<c?(6>e?(b[0].height=l(b[0].height-r),b=this.recalculateYAxisPositions(b,r)):(a=100/e,b=this.recalculateYAxisPositions(b,a/
(e-1),!0,-1)),b[e-1]={top:l(100-a),height:a}):(r=100*l(1-c),5>e?(b[0].height=l(b[0].height+r),b=this.recalculateYAxisPositions(b,r)):b=this.recalculateYAxisPositions(b,r/e,!0,1));b.forEach(function(a,b){d[b].update({height:a.height+"%",top:a.top+"%",resize:k[b]},!1)})},recalculateYAxisPositions:function(a,b,d,e){a.forEach(function(k,c){c=a[c-1];k.top=c?l(c.height+c.top):0;d&&(k.height=l(k.height+e*b))});return a}});g={segment:{className:"highcharts-segment",start:function(a){a=this.chart.pointer.getCoordinates(a);
var b=this.chart.options.navigation;a=h({langKey:"segment",type:"crookedLine",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.segment.annotationsOptions);return this.chart.addAnnotation(a)},steps:[c.updateNthPoint(1)]},arrowSegment:{className:"highcharts-arrow-segment",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"arrowSegment",type:"crookedLine",typeOptions:{line:{markerEnd:"arrow"},
points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.arrowSegment.annotationsOptions);return this.chart.addAnnotation(a)},steps:[c.updateNthPoint(1)]},ray:{className:"highcharts-ray",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"ray",type:"crookedLine",typeOptions:{type:"ray",points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,
b.bindings.ray.annotationsOptions);return this.chart.addAnnotation(a)},steps:[c.updateNthPoint(1)]},arrowRay:{className:"highcharts-arrow-ray",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"arrowRay",type:"infinityLine",typeOptions:{type:"ray",line:{markerEnd:"arrow"},points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.arrowRay.annotationsOptions);return this.chart.addAnnotation(a)},
steps:[c.updateNthPoint(1)]},infinityLine:{className:"highcharts-infinity-line",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"infinityLine",type:"infinityLine",typeOptions:{type:"line",points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.infinityLine.annotationsOptions);return this.chart.addAnnotation(a)},steps:[c.updateNthPoint(1)]},arrowInfinityLine:{className:"highcharts-arrow-infinity-line",
start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"arrowInfinityLine",type:"infinityLine",typeOptions:{type:"line",line:{markerEnd:"arrow"},points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.arrowInfinityLine.annotationsOptions);return this.chart.addAnnotation(a)},steps:[c.updateNthPoint(1)]},horizontalLine:{className:"highcharts-horizontal-line",start:function(a){a=this.chart.pointer.getCoordinates(a);
var b=this.chart.options.navigation;a=h({langKey:"horizontalLine",type:"infinityLine",draggable:"y",typeOptions:{type:"horizontalLine",points:[{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.horizontalLine.annotationsOptions);this.chart.addAnnotation(a)}},verticalLine:{className:"highcharts-vertical-line",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"verticalLine",type:"infinityLine",draggable:"x",typeOptions:{type:"verticalLine",
points:[{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.verticalLine.annotationsOptions);this.chart.addAnnotation(a)}},crooked3:{className:"highcharts-crooked3",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"crooked3",type:"crookedLine",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.crooked3.annotationsOptions);
return this.chart.addAnnotation(a)},steps:[c.updateNthPoint(1),c.updateNthPoint(2)]},crooked5:{className:"highcharts-crooked5",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"crookedLine",type:"crookedLine",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,
b.bindings.crooked5.annotationsOptions);return this.chart.addAnnotation(a)},steps:[c.updateNthPoint(1),c.updateNthPoint(2),c.updateNthPoint(3),c.updateNthPoint(4)]},elliott3:{className:"highcharts-elliott3",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"elliott3",type:"elliottWave",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,
y:a.yAxis[0].value}]},labelOptions:{style:{color:"#666666"}}},b.annotationsOptions,b.bindings.elliott3.annotationsOptions);return this.chart.addAnnotation(a)},steps:[c.updateNthPoint(1),c.updateNthPoint(2),c.updateNthPoint(3)]},elliott5:{className:"highcharts-elliott5",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"elliott5",type:"elliottWave",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},
{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]},labelOptions:{style:{color:"#666666"}}},b.annotationsOptions,b.bindings.elliott5.annotationsOptions);return this.chart.addAnnotation(a)},steps:[c.updateNthPoint(1),c.updateNthPoint(2),c.updateNthPoint(3),c.updateNthPoint(4),c.updateNthPoint(5)]},measureX:{className:"highcharts-measure-x",start:function(a){a=this.chart.pointer.getCoordinates(a);
var b=this.chart.options.navigation;a=h({langKey:"measure",type:"measure",typeOptions:{selectType:"x",point:{x:a.xAxis[0].value,y:a.yAxis[0].value,xAxis:0,yAxis:0},crosshairX:{strokeWidth:1,stroke:"#000000"},crosshairY:{enabled:!1,strokeWidth:0,stroke:"#000000"},background:{width:0,height:0,strokeWidth:0,stroke:"#ffffff"}},labelOptions:{style:{color:"#666666"}}},b.annotationsOptions,b.bindings.measureX.annotationsOptions);return this.chart.addAnnotation(a)},steps:[c.updateRectSize]},measureY:{className:"highcharts-measure-y",
start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"measure",type:"measure",typeOptions:{selectType:"y",point:{x:a.xAxis[0].value,y:a.yAxis[0].value,xAxis:0,yAxis:0},crosshairX:{enabled:!1,strokeWidth:0,stroke:"#000000"},crosshairY:{strokeWidth:1,stroke:"#000000"},background:{width:0,height:0,strokeWidth:0,stroke:"#ffffff"}},labelOptions:{style:{color:"#666666"}}},b.annotationsOptions,b.bindings.measureY.annotationsOptions);return this.chart.addAnnotation(a)},
steps:[c.updateRectSize]},measureXY:{className:"highcharts-measure-xy",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"measure",type:"measure",typeOptions:{selectType:"xy",point:{x:a.xAxis[0].value,y:a.yAxis[0].value,xAxis:0,yAxis:0},background:{width:0,height:0,strokeWidth:10},crosshairX:{strokeWidth:1,stroke:"#000000"},crosshairY:{strokeWidth:1,stroke:"#000000"}},labelOptions:{style:{color:"#666666"}}},b.annotationsOptions,b.bindings.measureXY.annotationsOptions);
return this.chart.addAnnotation(a)},steps:[c.updateRectSize]},fibonacci:{className:"highcharts-fibonacci",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"fibonacci",type:"fibonacci",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]},labelOptions:{style:{color:"#666666"}}},b.annotationsOptions,b.bindings.fibonacci.annotationsOptions);return this.chart.addAnnotation(a)},steps:[c.updateNthPoint(1),
c.updateHeight]},parallelChannel:{className:"highcharts-parallel-channel",start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"parallelChannel",type:"tunnel",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}]}},b.annotationsOptions,b.bindings.parallelChannel.annotationsOptions);return this.chart.addAnnotation(a)},steps:[c.updateNthPoint(1),c.updateHeight]},pitchfork:{className:"highcharts-pitchfork",
start:function(a){a=this.chart.pointer.getCoordinates(a);var b=this.chart.options.navigation;a=h({langKey:"pitchfork",type:"pitchfork",typeOptions:{points:[{x:a.xAxis[0].value,y:a.yAxis[0].value,controlPoint:{style:{fill:"red"}}},{x:a.xAxis[0].value,y:a.yAxis[0].value},{x:a.xAxis[0].value,y:a.yAxis[0].value}],innerBackground:{fill:"rgba(100, 170, 255, 0.8)"}},shapeOptions:{strokeWidth:2}},b.annotationsOptions,b.bindings.pitchfork.annotationsOptions);return this.chart.addAnnotation(a)},steps:[c.updateNthPoint(1),
c.updateNthPoint(2)]},verticalCounter:{className:"highcharts-vertical-counter",start:function(a){a=c.attractToPoint(a,this.chart);var b=this.chart.options.navigation,d=f(this.verticalCounter)?this.verticalCounter:0;a=h({langKey:"verticalCounter",type:"verticalLine",typeOptions:{point:{x:a.x,y:a.y,xAxis:a.xAxis,yAxis:a.yAxis},label:{offset:a.below?40:-40,text:d.toString()}},labelOptions:{style:{color:"#666666",fontSize:"11px"}},shapeOptions:{stroke:"rgba(0, 0, 0, 0.75)",strokeWidth:1}},b.annotationsOptions,
b.bindings.verticalCounter.annotationsOptions);a=this.chart.addAnnotation(a);a.options.events.click.call(a,{})}},verticalLabel:{className:"highcharts-vertical-label",start:function(a){a=c.attractToPoint(a,this.chart);var b=this.chart.options.navigation;a=h({langKey:"verticalLabel",type:"verticalLine",typeOptions:{point:{x:a.x,y:a.y,xAxis:a.xAxis,yAxis:a.yAxis},label:{offset:a.below?40:-40}},labelOptions:{style:{color:"#666666",fontSize:"11px"}},shapeOptions:{stroke:"rgba(0, 0, 0, 0.75)",strokeWidth:1}},
b.annotationsOptions,b.bindings.verticalLabel.annotationsOptions);a=this.chart.addAnnotation(a);a.options.events.click.call(a,{})}},verticalArrow:{className:"highcharts-vertical-arrow",start:function(a){a=c.attractToPoint(a,this.chart);var b=this.chart.options.navigation;a=h({langKey:"verticalArrow",type:"verticalLine",typeOptions:{point:{x:a.x,y:a.y,xAxis:a.xAxis,yAxis:a.yAxis},label:{offset:a.below?40:-40,format:" "},connector:{fill:"none",stroke:a.below?"red":"green"}},shapeOptions:{stroke:"rgba(0, 0, 0, 0.75)",
strokeWidth:1}},b.annotationsOptions,b.bindings.verticalArrow.annotationsOptions);a=this.chart.addAnnotation(a);a.options.events.click.call(a,{})}},flagCirclepin:{className:"highcharts-flag-circlepin",start:c.addFlagFromForm("circlepin")},flagDiamondpin:{className:"highcharts-flag-diamondpin",start:c.addFlagFromForm("flag")},flagSquarepin:{className:"highcharts-flag-squarepin",start:c.addFlagFromForm("squarepin")},flagSimplepin:{className:"highcharts-flag-simplepin",start:c.addFlagFromForm("nopin")},
zoomX:{className:"highcharts-zoom-x",init:function(a){this.chart.update({chart:{zoomType:"x"}});m(this,"deselectButton",{button:a})}},zoomY:{className:"highcharts-zoom-y",init:function(a){this.chart.update({chart:{zoomType:"y"}});m(this,"deselectButton",{button:a})}},zoomXY:{className:"highcharts-zoom-xy",init:function(a){this.chart.update({chart:{zoomType:"xy"}});m(this,"deselectButton",{button:a})}},seriesTypeLine:{className:"highcharts-series-type-line",init:function(a){this.chart.series[0].update({type:"line",
useOhlcData:!0});m(this,"deselectButton",{button:a})}},seriesTypeOhlc:{className:"highcharts-series-type-ohlc",init:function(a){this.chart.series[0].update({type:"ohlc"});m(this,"deselectButton",{button:a})}},seriesTypeCandlestick:{className:"highcharts-series-type-candlestick",init:function(a){this.chart.series[0].update({type:"candlestick"});m(this,"deselectButton",{button:a})}},fullScreen:{className:"highcharts-full-screen",init:function(a){m(this,"deselectButton",{button:a})}},currentPriceIndicator:{className:"highcharts-current-price-indicator",
init:function(a){var b=this.chart,d=b.series[0],e=d.options,c=e.lastVisiblePrice&&e.lastVisiblePrice.enabled;e=e.lastPrice&&e.lastPrice.enabled;b=b.stockTools;var p=b.getIconsURL();b&&b.guiEnabled&&(a.firstChild.style["background-image"]=e?'url("'+p+'current-price-show.svg")':'url("'+p+'current-price-hide.svg")');d.update({lastPrice:{enabled:!e,color:"red"},lastVisiblePrice:{enabled:!c,label:{enabled:!0}}});m(this,"deselectButton",{button:a})}},indicators:{className:"highcharts-indicators",init:function(){var a=
this;m(a,"showPopup",{formType:"indicators",options:{},onSubmit:function(b){a.utils.manageIndicators.call(a,b)}})}},toggleAnnotations:{className:"highcharts-toggle-annotations",init:function(a){var b=this.chart,d=b.stockTools,e=d.getIconsURL();this.toggledAnnotations=!this.toggledAnnotations;(b.annotations||[]).forEach(function(a){a.setVisibility(!this.toggledAnnotations)},this);d&&d.guiEnabled&&(a.firstChild.style["background-image"]=this.toggledAnnotations?'url("'+e+'annotations-hidden.svg")':'url("'+
e+'annotations-visible.svg")');m(this,"deselectButton",{button:a})}},saveChart:{className:"highcharts-save-chart",init:function(a){var b=this,d=b.chart,e=[],c=[],p=[],r=[];d.annotations.forEach(function(a,b){e[b]=a.userOptions});d.series.forEach(function(a){a.is("sma")?c.push(a.userOptions):"flags"===a.type&&p.push(a.userOptions)});d.yAxis.forEach(function(a){b.utils.isNotNavigatorYAxis(a)&&r.push(a.options)});q.win.localStorage.setItem("highcharts-chart",JSON.stringify({annotations:e,indicators:c,
flags:p,yAxes:r}));m(this,"deselectButton",{button:a})}}};q.setOptions({navigation:{bindings:g}})});t(f,"modules/stock-tools-gui.js",[f["parts/Globals.js"],f["parts/Utilities.js"]],function(f,g){var l=g.addEvent,n=g.createElement,t=g.css,q=g.extend,h=g.fireEvent,u=g.getStyle,w=g.isArray,m=g.merge,c=g.pick,a=f.win;f.setOptions({lang:{stockTools:{gui:{simpleShapes:"Simple shapes",lines:"Lines",crookedLines:"Crooked lines",measure:"Measure",advanced:"Advanced",toggleAnnotations:"Toggle annotations",
verticalLabels:"Vertical labels",flags:"Flags",zoomChange:"Zoom change",typeChange:"Type change",saveChart:"Save chart",indicators:"Indicators",currentPriceIndicator:"Current Price Indicators",zoomX:"Zoom X",zoomY:"Zoom Y",zoomXY:"Zooom XY",fullScreen:"Fullscreen",typeOHLC:"OHLC",typeLine:"Line",typeCandlestick:"Candlestick",circle:"Circle",label:"Label",rectangle:"Rectangle",flagCirclepin:"Flag circle",flagDiamondpin:"Flag diamond",flagSquarepin:"Flag square",flagSimplepin:"Flag simple",measureXY:"Measure XY",
measureX:"Measure X",measureY:"Measure Y",segment:"Segment",arrowSegment:"Arrow segment",ray:"Ray",arrowRay:"Arrow ray",line:"Line",arrowLine:"Arrow line",horizontalLine:"Horizontal line",verticalLine:"Vertical line",infinityLine:"Infinity line",crooked3:"Crooked 3 line",crooked5:"Crooked 5 line",elliott3:"Elliott 3 line",elliott5:"Elliott 5 line",verticalCounter:"Vertical counter",verticalLabel:"Vertical label",verticalArrow:"Vertical arrow",fibonacci:"Fibonacci",pitchfork:"Pitchfork",parallelChannel:"Parallel channel"}},
navigation:{popup:{circle:"Circle",rectangle:"Rectangle",label:"Label",segment:"Segment",arrowSegment:"Arrow segment",ray:"Ray",arrowRay:"Arrow ray",line:"Line",arrowLine:"Arrow line",horizontalLine:"Horizontal line",verticalLine:"Vertical line",crooked3:"Crooked 3 line",crooked5:"Crooked 5 line",elliott3:"Elliott 3 line",elliott5:"Elliott 5 line",verticalCounter:"Vertical counter",verticalLabel:"Vertical label",verticalArrow:"Vertical arrow",fibonacci:"Fibonacci",pitchfork:"Pitchfork",parallelChannel:"Parallel channel",
infinityLine:"Infinity line",measure:"Measure",measureXY:"Measure XY",measureX:"Measure X",measureY:"Measure Y",flags:"Flags",addButton:"add",saveButton:"save",editButton:"edit",removeButton:"remove",series:"Series",volume:"Volume",connector:"Connector",innerBackground:"Inner background",outerBackground:"Outer background",crosshairX:"Crosshair X",crosshairY:"Crosshair Y",tunnel:"Tunnel",background:"Background"}}},stockTools:{gui:{enabled:!0,className:"highcharts-bindings-wrapper",toolbarClassName:"stocktools-toolbar",
buttons:"indicators separator simpleShapes lines crookedLines measure advanced toggleAnnotations separator verticalLabels flags separator zoomChange fullScreen typeChange separator currentPriceIndicator saveChart".split(" "),definitions:{separator:{symbol:"separator.svg"},simpleShapes:{items:["label","circle","rectangle"],circle:{symbol:"circle.svg"},rectangle:{symbol:"rectangle.svg"},label:{symbol:"label.svg"}},flags:{items:["flagCirclepin","flagDiamondpin","flagSquarepin","flagSimplepin"],flagSimplepin:{symbol:"flag-basic.svg"},
flagDiamondpin:{symbol:"flag-diamond.svg"},flagSquarepin:{symbol:"flag-trapeze.svg"},flagCirclepin:{symbol:"flag-elipse.svg"}},lines:{items:"segment arrowSegment ray arrowRay line arrowLine horizontalLine verticalLine".split(" "),segment:{symbol:"segment.svg"},arrowSegment:{symbol:"arrow-segment.svg"},ray:{symbol:"ray.svg"},arrowRay:{symbol:"arrow-ray.svg"},line:{symbol:"line.svg"},arrowLine:{symbol:"arrow-line.svg"},verticalLine:{symbol:"vertical-line.svg"},horizontalLine:{symbol:"horizontal-line.svg"}},
crookedLines:{items:["elliott3","elliott5","crooked3","crooked5"],crooked3:{symbol:"crooked-3.svg"},crooked5:{symbol:"crooked-5.svg"},elliott3:{symbol:"elliott-3.svg"},elliott5:{symbol:"elliott-5.svg"}},verticalLabels:{items:["verticalCounter","verticalLabel","verticalArrow"],verticalCounter:{symbol:"vertical-counter.svg"},verticalLabel:{symbol:"vertical-label.svg"},verticalArrow:{symbol:"vertical-arrow.svg"}},advanced:{items:["fibonacci","pitchfork","parallelChannel"],pitchfork:{symbol:"pitchfork.svg"},
fibonacci:{symbol:"fibonacci.svg"},parallelChannel:{symbol:"parallel-channel.svg"}},measure:{items:["measureXY","measureX","measureY"],measureX:{symbol:"measure-x.svg"},measureY:{symbol:"measure-y.svg"},measureXY:{symbol:"measure-xy.svg"}},toggleAnnotations:{symbol:"annotations-visible.svg"},currentPriceIndicator:{symbol:"current-price-show.svg"},indicators:{symbol:"indicators.svg"},zoomChange:{items:["zoomX","zoomY","zoomXY"],zoomX:{symbol:"zoom-x.svg"},zoomY:{symbol:"zoom-y.svg"},zoomXY:{symbol:"zoom-xy.svg"}},
typeChange:{items:["typeOHLC","typeLine","typeCandlestick"],typeOHLC:{symbol:"series-ohlc.svg"},typeLine:{symbol:"series-line.svg"},typeCandlestick:{symbol:"series-candlestick.svg"}},fullScreen:{symbol:"fullscreen.svg"},saveChart:{symbol:"save-chart.svg"}}}}});l(f.Chart,"afterGetContainer",function(){this.setStockTools()});l(f.Chart,"getMargins",function(){var a=this.stockTools&&this.stockTools.listWrapper;(a=a&&(a.startWidth+u(a,"padding-left")+u(a,"padding-right")||a.offsetWidth))&&a<this.plotWidth&&
(this.plotLeft+=a)});l(f.Chart,"destroy",function(){this.stockTools&&this.stockTools.destroy()});l(f.Chart,"redraw",function(){this.stockTools&&this.stockTools.guiEnabled&&this.stockTools.redraw()});f.Toolbar=function(a,d,e){this.chart=e;this.options=a;this.lang=d;this.iconsURL=this.getIconsURL();this.guiEnabled=a.enabled;this.visible=c(a.visible,!0);this.placed=c(a.placed,!1);this.eventsToUnbind=[];this.guiEnabled&&(this.createHTML(),this.init(),this.showHideNavigatorion());h(this,"afterInit")};
q(f.Chart.prototype,{setStockTools:function(a){var b=this.options,e=b.lang;a=m(b.stockTools&&b.stockTools.gui,a&&a.gui);this.stockTools=new f.Toolbar(a,e.stockTools&&e.stockTools.gui,this);this.stockTools.guiEnabled&&(this.isDirtyBox=!0)}});f.Toolbar.prototype={init:function(){var a=this,d=this.lang,e=this.options,c=this.toolbar,p=a.addSubmenu,f=e.buttons,h=e.definitions,g=c.childNodes,m=this.inIframe(),n;f.forEach(function(b){n=a.addButton(c,h,b,d);m&&"fullScreen"===b&&(n.buttonWrapper.className+=
" highcharts-disabled-btn");a.eventsToUnbind.push(l(n.buttonWrapper,"click",function(){a.eraseActiveButtons(g,n.buttonWrapper)}));w(h[b].items)&&p.call(a,n,h[b])})},addSubmenu:function(a,d){var b=this,c=a.submenuArrow,f=a.buttonWrapper,r=u(f,"width"),h=this.wrapper,g=this.listWrapper,m=this.toolbar.childNodes,q=0,v;this.submenu=v=n("ul",{className:"highcharts-submenu-wrapper"},null,f);this.addSubmenuItems(f,d);b.eventsToUnbind.push(l(c,"click",function(a){a.stopPropagation();b.eraseActiveButtons(m,
f);0<=f.className.indexOf("highcharts-current")?(g.style.width=g.startWidth+"px",f.classList.remove("highcharts-current"),v.style.display="none"):(v.style.display="block",q=v.offsetHeight-f.offsetHeight-3,v.offsetHeight+f.offsetTop>h.offsetHeight&&f.offsetTop>q||(q=0),t(v,{top:-q+"px",left:r+3+"px"}),f.className+=" highcharts-current",g.startWidth=h.offsetWidth,g.style.width=g.startWidth+u(g,"padding-left")+v.offsetWidth+3+"px")}))},addSubmenuItems:function(a,d){var b=this,c=this.submenu,f=this.lang,
g=this.listWrapper,h;d.items.forEach(function(e){h=b.addButton(c,d,e,f);b.eventsToUnbind.push(l(h.mainButton,"click",function(){b.switchSymbol(this,a,!0);g.style.width=g.startWidth+"px";c.style.display="none"}))});var m=c.querySelectorAll("li > .highcharts-menu-item-btn")[0];b.switchSymbol(m,!1)},eraseActiveButtons:function(a,d,e){[].forEach.call(a,function(a){a!==d&&(a.classList.remove("highcharts-current"),a.classList.remove("highcharts-active"),e=a.querySelectorAll(".highcharts-submenu-wrapper"),
0<e.length&&(e[0].style.display="none"))})},addButton:function(a,d,e,k){d=d[e];var b=d.items,g=d.className||"";e=n("li",{className:c(f.Toolbar.prototype.classMapping[e],"")+" "+g,title:k[e]||e},null,a);a=n("span",{className:"highcharts-menu-item-btn"},null,e);if(b&&b.length){var h=n("span",{className:"highcharts-submenu-item-arrow highcharts-arrow-right"},null,e);h.style["background-image"]="url("+this.iconsURL+"arrow-bottom.svg)"}else a.style["background-image"]="url("+this.iconsURL+d.symbol+")";
return{buttonWrapper:e,mainButton:a,submenuArrow:h}},addNavigation:function(){var a=this.wrapper;this.arrowWrapper=n("div",{className:"highcharts-arrow-wrapper"});this.arrowUp=n("div",{className:"highcharts-arrow-up"},null,this.arrowWrapper);this.arrowUp.style["background-image"]="url("+this.iconsURL+"arrow-right.svg)";this.arrowDown=n("div",{className:"highcharts-arrow-down"},null,this.arrowWrapper);this.arrowDown.style["background-image"]="url("+this.iconsURL+"arrow-right.svg)";a.insertBefore(this.arrowWrapper,
a.childNodes[0]);this.scrollButtons()},scrollButtons:function(){var a=0,d=this.wrapper,e=this.toolbar,c=.1*d.offsetHeight;this.eventsToUnbind.push(l(this.arrowUp,"click",function(){0<a&&(a-=c,e.style["margin-top"]=-a+"px")}));this.eventsToUnbind.push(l(this.arrowDown,"click",function(){d.offsetHeight+a<=e.offsetHeight+c&&(a+=c,e.style["margin-top"]=-a+"px")}))},createHTML:function(){var a=this.chart,d=this.options,e=a.container;a=a.options.navigation;this.wrapper=a=n("div",{className:"highcharts-stocktools-wrapper "+
d.className+" "+(a&&a.bindingsClassName)});e.parentNode.insertBefore(a,e);this.toolbar=e=n("ul",{className:"highcharts-stocktools-toolbar "+d.toolbarClassName});this.listWrapper=d=n("div",{className:"highcharts-menu-wrapper"});a.insertBefore(d,a.childNodes[0]);d.insertBefore(e,d.childNodes[0]);this.showHideToolbar();this.addNavigation()},showHideNavigatorion:function(){this.visible&&this.toolbar.offsetHeight>this.wrapper.offsetHeight-50?this.arrowWrapper.style.display="block":(this.toolbar.style.marginTop=
"0px",this.arrowWrapper.style.display="none")},showHideToolbar:function(){var a=this.chart,d=this.wrapper,e=this.listWrapper,c=this.submenu,f=this.visible,g;this.showhideBtn=g=n("div",{className:"highcharts-toggle-toolbar highcharts-arrow-left"},null,d);g.style["background-image"]="url("+this.iconsURL+"arrow-right.svg)";f?(d.style.height="100%",g.style.top=u(e,"padding-top")+"px",g.style.left=d.offsetWidth+u(e,"padding-left")+"px"):(c&&(c.style.display="none"),g.style.left="0px",this.visible=f=!1,
e.classList.add("highcharts-hide"),g.classList.toggle("highcharts-arrow-right"),d.style.height=g.offsetHeight+"px");this.eventsToUnbind.push(l(g,"click",function(){a.update({stockTools:{gui:{visible:!f,placed:!0}}})}))},switchSymbol:function(a,d){var b=a.parentNode,c=b.classList.value;b=b.parentNode.parentNode;b.className="";c&&b.classList.add(c.trim());b.querySelectorAll(".highcharts-menu-item-btn")[0].style["background-image"]=a.style["background-image"];d&&this.selectButton(b)},selectButton:function(a){0<=
a.className.indexOf("highcharts-active")?a.classList.remove("highcharts-active"):a.classList.add("highcharts-active")},unselectAllButtons:function(a){var b=a.parentNode.querySelectorAll(".highcharts-active");[].forEach.call(b,function(b){b!==a&&b.classList.remove("highcharts-active")})},inIframe:function(){try{return a.self!==a.top}catch(b){return!0}},update:function(a){m(!0,this.chart.options.stockTools,a);this.destroy();this.chart.setStockTools(a);this.chart.navigationBindings&&this.chart.navigationBindings.update()},
destroy:function(){var a=this.wrapper,d=a&&a.parentNode;this.eventsToUnbind.forEach(function(a){a()});d&&d.removeChild(a);this.chart.isDirtyBox=!0;this.chart.redraw()},redraw:function(){this.showHideNavigatorion()},getIconsURL:function(){return this.chart.options.navigation.iconsURL||this.options.iconsURL||"https://code.highcharts.com/8.0.1/gfx/stock-icons/"},classMapping:{circle:"highcharts-circle-annotation",rectangle:"highcharts-rectangle-annotation",label:"highcharts-label-annotation",segment:"highcharts-segment",
arrowSegment:"highcharts-arrow-segment",ray:"highcharts-ray",arrowRay:"highcharts-arrow-ray",line:"highcharts-infinity-line",arrowLine:"highcharts-arrow-infinity-line",verticalLine:"highcharts-vertical-line",horizontalLine:"highcharts-horizontal-line",crooked3:"highcharts-crooked3",crooked5:"highcharts-crooked5",elliott3:"highcharts-elliott3",elliott5:"highcharts-elliott5",pitchfork:"highcharts-pitchfork",fibonacci:"highcharts-fibonacci",parallelChannel:"highcharts-parallel-channel",measureX:"highcharts-measure-x",
measureY:"highcharts-measure-y",measureXY:"highcharts-measure-xy",verticalCounter:"highcharts-vertical-counter",verticalLabel:"highcharts-vertical-label",verticalArrow:"highcharts-vertical-arrow",currentPriceIndicator:"highcharts-current-price-indicator",indicators:"highcharts-indicators",flagCirclepin:"highcharts-flag-circlepin",flagDiamondpin:"highcharts-flag-diamondpin",flagSquarepin:"highcharts-flag-squarepin",flagSimplepin:"highcharts-flag-simplepin",zoomX:"highcharts-zoom-x",zoomY:"highcharts-zoom-y",
zoomXY:"highcharts-zoom-xy",typeLine:"highcharts-series-type-line",typeOHLC:"highcharts-series-type-ohlc",typeCandlestick:"highcharts-series-type-candlestick",fullScreen:"highcharts-full-screen",toggleAnnotations:"highcharts-toggle-annotations",saveChart:"highcharts-save-chart",separator:"highcharts-separator"}};l(f.NavigationBindings,"selectButton",function(a){var b=a.button,c=this.chart.stockTools;c&&c.guiEnabled&&(c.unselectAllButtons(a.button),0<=b.parentNode.className.indexOf("highcharts-submenu-wrapper")&&
(b=b.parentNode.parentNode),c.selectButton(b))});l(f.NavigationBindings,"deselectButton",function(a){a=a.button;var b=this.chart.stockTools;b&&b.guiEnabled&&(0<=a.parentNode.className.indexOf("highcharts-submenu-wrapper")&&(a=a.parentNode.parentNode),b.selectButton(a))})});t(f,"masters/modules/stock-tools.src.js",[],function(){})});
//# sourceMappingURL=stock-tools.js.map