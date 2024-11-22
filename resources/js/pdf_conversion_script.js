// Function to generate and send PDF
function generateAndSendPDF() {
    // HTML content to convert to PDF
    var htmlContent = "<h1>Hello World</h1>";

    // Conversion options
    var conversionOptions = {
        html: htmlContent,
        allowLocalFilesAccess: true,
        waitForJS: true,
        waitForJSVarName: 'PHANTOM_HTML_TO_PDF_READY', // Custom variable name for programmatic PDF printing
        viewportSize: { width: 800, height: 600 },
        format: { quality: 100 },
        header: '<h2>This is the header</h2>', // Custom header
        footer: '<div style="text-align:center">{#pageNum}/{#numPages}</div>' // Custom footer with page numbers
    };

    // Load the phantom-html-to-pdf script from CDN
    var script = document.createElement('script');
    script.src = "https://cdn.jsdelivr.net/npm/phantom-html-to-pdf@0.8.3/index.min.js";
    document.head.appendChild(script);

    // Wait for the script to load
    script.onload = function() {
        console.log('Script loaded successfully');

        // Perform the conversion once the script is loaded
        var conversion = phantomHtmlToPdf(conversionOptions, function(err, pdf) {
            if (err) {
                console.error('Error generating PDF:', err);
            } else {
                // Output PDF details
                console.log('PDF logs:', pdf.logs);
                console.log('Number of pages:', pdf.numberOfPages);

                // Create a blob URL for the PDF
                var pdfBlob = new Blob([pdf.output], { type: 'application/pdf' });
                var pdfUrl = URL.createObjectURL(pdfBlob);

                // Open the PDF in a new tab
                window.open(pdfUrl);

                // Cleanup
                URL.revokeObjectURL(pdfUrl);
            }
        });
    };

    // Log when the function is called
    console.log('Function called');
}

// Call the function to generate and send PDF
generateAndSendPDF();
