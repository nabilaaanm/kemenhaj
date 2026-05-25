<style>
    .rich-content {
        line-height: 1.75;
        color: inherit;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .rich-content p,
    .rich-content figure,
    .rich-content h1,
    .rich-content h2,
    .rich-content h3 {
        margin: 0 0 1em;
    }

    .rich-content img {
        max-width: 100%;
        height: auto;
    }

    /* Gambar di paragraf/span yang di-align center di editor */
    .rich-content p[style*="text-align: center"] img,
    .rich-content p[style*="text-align:center"] img,
    .rich-content div[style*="text-align: center"] img,
    .rich-content div[style*="text-align:center"] img,
    .rich-content p[style*="text-align: center"] span:has(img),
    .rich-content p[style*="text-align:center"] span:has(img),
    .rich-content .aligncenter,
    .rich-content img.aligncenter,
    .rich-content figure.image-style-align-center,
    .rich-content .image-style-align-center {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .rich-content p[style*="text-align: center"] span:has(img),
    .rich-content p[style*="text-align:center"] span:has(img) {
        width: fit-content;
        max-width: 100%;
    }

    .rich-content figure.image {
        display: table;
        max-width: 100%;
        margin: 1.25em auto;
        text-align: center;
    }

    .rich-content figure.image img {
        display: block;
        margin: 0 auto;
    }

    .rich-content img[style*="margin-left: auto"],
    .rich-content img[style*="margin-left:auto"],
    .rich-content img[style*="margin: 0 auto"],
    .rich-content img[style*="margin:0 auto"] {
        display: block !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }

    .rich-content p[style*="text-align: right"] img,
    .rich-content p[style*="text-align:right"] img,
    .rich-content .alignright,
    .rich-content img.alignright {
        display: block;
        margin-left: auto;
        margin-right: 0;
    }

    .rich-content p[style*="text-align: left"] img,
    .rich-content p[style*="text-align:left"] img,
    .rich-content .alignleft,
    .rich-content img.alignleft {
        display: block;
        margin-left: 0;
        margin-right: auto;
    }
</style>
