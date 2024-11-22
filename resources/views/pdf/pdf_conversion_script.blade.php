

var system = require('system');
var page = require('webpage').create();

var inputFile = system.args[1];
var outputFile = system.args[2];

page.viewportSize = { width: 800, height: 600 };

page.open(inputFile, function(status) {
    if (status !== 'success') {
        console.log('Unable to load the HTML file!');
        phantom.exit();
    } else {
        page.evaluate(function() {
            autoPrint();
            redirectToPreviewPage();
        });
        setTimeout(function() {
            page.render(outputFile);
            phantom.exit();
        }, 3000);
    }
});
