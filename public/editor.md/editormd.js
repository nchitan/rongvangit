!function(e) {
    "use strict";
    "function" == typeof require && "object" == typeof exports && "object" == typeof module ? module.exports = e : "function" == typeof define ? define.amd || define(["jquery"], e) : window.editormd = e()
}(function() {
    "use strict";
    var e = "undefined" != typeof jQuery ? jQuery : Zepto;
    if (void 0 !== e) {
        var t, i, o = function(e, t) {
            return new o.fn.init(e,t)
        };
        o.title = o.$name = "Editor.md",
        o.version = "1.5.0",
        o.homePage = "https://pandao.github.io/editor.md/",
        o.classPrefix = "editormd-",
        o.toolbarModes = {
            full: ["undo", "redo", "|", "bold", "del", "italic", "quote", "ucwords", "uppercase", "lowercase", "|", "h1", "h2", "h3", "h4", "h5", "h6", "|", "list-ul", "list-ol", "hr", "|", "link", "reference-link", "image", "code", "preformatted-text", "code-block", "table", "datetime", "emoji", "html-entities", "pagebreak", "|", "goto-line", "watch", "preview", "fullscreen", "clear", "search", "|", "help", "info"],
            simple: ["undo", "redo", "|", "bold", "del", "italic", "|", "h2", "h3", "h4", "|", "code-block", "code", "|", "goto-line", "quote", "table", "|", "list-ul", "list-ol", "hr", "|", "link", "datetime", "|", "image", "html-entities", "|", "watch", "preview", "|"],
            mini: ["undo", "redo", "|", "watch", "preview", "|", "help", "info"]
        },
        o.defaults = {
            mode: "gfm",
            name: "",
            value: "",
            theme: "",
            editorTheme: "default",
            previewTheme: "",
            markdown: "",
            appendMarkdown: "",
            width: "100%",
            height: "100%",
            path: "./lib/",
            pluginPath: "",
            delay: 300,
            autoLoadModules: !0,
            watch: !0,
            placeholder: "Enjoy Markdown! coding now...",
            gotoLine: !0,
            codeFold: !1,
            autoHeight: !1,
            autoFocus: !0,
            autoCloseTags: !0,
            searchReplace: !0,
            syncScrolling: !0,
            readOnly: !1,
            tabSize: 4,
            indentUnit: 4,
            lineNumbers: !1,
            lineWrapping: !0,
            autoCloseBrackets: !0,
            showTrailingSpace: !0,
            matchBrackets: !0,
            indentWithTabs: !0,
            styleSelectedText: !0,
            matchWordHighlight: !0,
            styleActiveLine: !0,
            dialogLockScreen: !0,
            dialogShowMask: !0,
            dialogDraggable: !0,
            dialogMaskBgColor: "#fff",
            dialogMaskOpacity: .1,
            fontSize: "13px",
            saveHTMLToTextarea: !1,
            disabledKeyMaps: [],
            onload: function() {},
            onresize: function() {},
            onchange: function() {},
            onwatch: null,
            onunwatch: null,
            onpreviewing: function() {},
            onpreviewed: function() {},
            onfullscreen: function() {},
            onfullscreenExit: function() {},
            onscroll: function() {},
            onpreviewscroll: function() {},
            imageUpload: !0,
            imageFormats: ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL: "./php/upload.php",
            crossDomainUpload: !1,
            uploadCallbackURL: "",
            toc: !0,
            tocm: !1,
            tocTitle: "",
            tocDropdown: !1,
            tocContainer: "",
            tocStartLevel: 1,
            htmlDecode: !0,
            pageBreak: !0,
            atLink: !0,
            emailLink: !0,
            taskList: !1,
            emoji: !0,
            tex: !1,
            flowChart: !1,
            sequenceDiagram: !1,
            previewCodeHighlight: !0,
            toolbar: !0,
            toolbarAutoFixed: !0,
            toolbarIcons: "simple",
            toolbarTitles: {},
            toolbarHandlers: {
                ucwords: function() {
                    return o.toolbarHandlers.ucwords
                },
                lowercase: function() {
                    return o.toolbarHandlers.lowercase
                }
            },
            toolbarCustomIcons: {
                lowercase: '<a href="javascript:;" title="Lowercase" unselectable="on"><i class="fa" name="lowercase" style="font-size:24px;margin-top: -10px;">a</i></a>',
                ucwords: '<a href="javascript:;" title="ucwords" unselectable="on"><i class="fa" name="ucwords" style="font-size:20px;margin-top: -3px;">Aa</i></a>'
            },
            toolbarIconsClass: {
                undo: "fa-undo",
                redo: "fa-repeat",
                bold: "fa-bold",
                del: "fa-strikethrough",
                italic: "fa-italic",
                quote: "fa-quote-left",
                uppercase: "fa-font",
                h1: o.classPrefix + "bold",
                h2: o.classPrefix + "bold",
                h3: o.classPrefix + "bold",
                h4: o.classPrefix + "bold",
                h5: o.classPrefix + "bold",
                h6: o.classPrefix + "bold",
                "list-ul": "fa-list-ul",
                "list-ol": "fa-list-ol",
                hr: "fa-minus",
                link: "fa-link",
                "reference-link": "fa-anchor",
                image: "fa-picture-o",
                code: "fa-code",
                "preformatted-text": "fa-file-code-o",
                "code-block": "fa-file-code-o",
                table: "fa-table",
                datetime: "fa-clock-o",
                emoji: "fa-smile-o",
                "html-entities": "fa-copyright",
                pagebreak: "fa-newspaper-o",
                "goto-line": "fa-terminal",
                watch: "fa-eye-slash",
                unwatch: "fa-eye",
                preview: "fa-desktop",
                search: "fa-search",
                fullscreen: "fa-arrows-alt",
                clear: "fa-eraser",
                help: "fa-question-circle",
                info: "fa-info-circle"
            },
            toolbarIconTexts: {},
            lang: {
                name: "en",
                description: "Open source online Markdown editor.",
                tocTitle: "Table of Contents",
                toolbar: {
                    undo: "Undo(Ctrl+Z)",
                    redo: "Redo(Ctrl+Y)",
                    bold: "Bold",
                    del: "Strikethrough",
                    italic: "Italic",
                    quote: "Block quote",
                    ucwords: "Words first letter convert to uppercase",
                    uppercase: "Selection text convert to uppercase",
                    lowercase: "Selection text convert to lowercase",
                    h1: "Heading 1",
                    h2: "Heading 2",
                    h3: "Heading 3",
                    h4: "Heading 4",
                    h5: "Heading 5",
                    h6: "Heading 6",
                    "list-ul": "Unordered list",
                    "list-ol": "Ordered list",
                    hr: "Horizontal rule",
                    link: "Link",
                    "reference-link": "Reference link",
                    image: "Image",
                    code: "Code inline",
                    "preformatted-text": "Preformatted text / Code block (Tab indent)",
                    "code-block": "Code block (Multi-languages)",
                    table: "Tables",
                    datetime: "Datetime",
                    emoji: "Emoji",
                    "html-entities": "HTML Entities",
                    pagebreak: "Page break",
                    watch: "Unwatch",
                    unwatch: "Watch",
                    preview: "HTML Preview (Press Shift + ESC exit)",
                    fullscreen: "Fullscreen (Press ESC exit)",
                    clear: "Clear",
                    search: "Search",
                    help: "Help",
                    info: "About" + o.title
                },
                buttons: {
                    enter: "Enter",
                    cancel: "Cancel",
                    close: "Close"
                },
                dialog: {
                    link: {
                        title: "Link",
                        url: "Address",
                        urlTitle: "Title",
                        urlEmpty: "Error: Please fill in the link address."
                    },
                    referenceLink: {
                        title: "Reference link",
                        name: "Name",
                        url: "Address",
                        urlId: "ID",
                        urlTitle: "Title",
                        nameEmpty: "Error: Reference name can't be empty.",
                        idEmpty: "Error: Please fill in reference link id.",
                        urlEmpty: "Error: Please fill in reference link url address."
                    },
                    image: {
                        title: "Image",
                        url: "Address",
                        link: "Link",
                        alt: "Title",
                        uploadButton: "Upload",
                        imageURLEmpty: "Error: picture url address can't be empty.",
                        uploadFileEmpty: "Error: upload pictures cannot be empty!",
                        formatNotAllowed: "Error: only allows to upload pictures file, upload allowed image file format:"
                    },
                    preformattedText: {
                        title: "Preformatted text / Codes",
                        emptyAlert: "Error: Please fill in the Preformatted text or content of the codes.",
                        placeholder: "coding now...."
                    },
                    codeBlock: {
                        title: "Code block",
                        selectLabel: "Languages: ",
                        selectDefaultText: "select a code language...",
                        otherLanguage: "Other languages",
                        unselectedLanguageAlert: "Error: Please select the code language.",
                        codeEmptyAlert: "Error: Please fill in the code content.",
                        placeholder: "coding now...."
                    },
                    htmlEntities: {
                        title: "HTML Entities"
                    },
                    help: {
                        title: "Help"
                    }
                }
            }
        },
        o.classNames = {
            tex: o.classPrefix + "tex"
        },
        o.dialogZindex = 99999,
        o.$katex = null,
        o.$marked = null,
        o.$CodeMirror = null,
        o.$prettyPrint = null,
        o.prototype = o.fn = {
            state: {
                watching: !1,
                loaded: !1,
                preview: !1,
                fullscreen: !1
            },
            init: function(t, i) {
                i = i || {},
                "object" == typeof t && (i = t);
                var r = this.classPrefix = o.classPrefix
                  , n = this.settings = e.extend(!0, {}, o.defaults, i);
                t = "object" == typeof t ? n.id : t;
                var a = this.editor = e("#" + t);
                this.id = t,
                this.lang = n.lang;
                var s = this.classNames = {
                    textarea: {
                        html: r + "html-textarea",
                        markdown: r + "markdown-textarea"
                    }
                };
                n.pluginPath = "" === n.pluginPath ? n.path + "../plugins/" : n.pluginPath,
                this.state.watching = !!n.watch,
                a.hasClass("editormd") || a.addClass("editormd"),
                a.css({
                    width: "number" == typeof n.width ? n.width + "px" : n.width,
                    height: "number" == typeof n.height ? n.height + "px" : n.height
                }),
                n.autoHeight && a.css("height", "auto");
                var l = this.markdownTextarea = a.children("textarea");
                l.length < 1 && (a.append("<textarea></textarea>"),
                l = this.markdownTextarea = a.children("textarea")),
                l.addClass(s.textarea.markdown).attr("placeholder", n.placeholder),
                void 0 !== l.attr("name") && "" !== l.attr("name") || l.attr("name", "" !== n.name ? n.name : t + "-markdown-doc");
                var c = [n.readOnly ? "" : '<a href="javascript:;" class="fa fa-close ' + r + 'preview-close-btn"></a>', n.saveHTMLToTextarea ? '<textarea class="' + s.textarea.html + '" name="' + t + '-html-code"></textarea>' : "", '<div class="' + r + 'preview"><div class="markdown-body ' + r + 'preview-container"></div></div>', '<div class="' + r + 'container-mask" style="display:block;"></div>', '<div class="' + r + 'mask"></div>'].join("\n");
                return a.append(c).addClass(r + "vertical"),
                "" !== n.theme && a.addClass(r + "theme-" + n.theme),
                this.mask = a.children("." + r + "mask"),
                this.containerMask = a.children("." + r + "container-mask"),
                "" !== n.markdown && l.val(n.markdown),
                "" !== n.appendMarkdown && l.val(l.val() + n.appendMarkdown),
                this.htmlTextarea = a.children("." + s.textarea.html),
                this.preview = a.children("." + r + "preview"),
                this.previewContainer = this.preview.children("." + r + "preview-container"),
                "" !== n.previewTheme && this.preview.addClass(r + "preview-theme-" + n.previewTheme),
                "function" == typeof define && define.amd && ("undefined" != typeof katex && (o.$katex = katex),
                n.searchReplace && !n.readOnly && (o.loadCSS(n.path + "codemirror/addon/dialog/dialog"),
                o.loadCSS(n.path + "codemirror/addon/search/matchesonscrollbar"))),
                "function" == typeof define && define.amd || !n.autoLoadModules ? ("undefined" != typeof CodeMirror && (o.$CodeMirror = CodeMirror),
                "undefined" != typeof marked && (o.$marked = marked),
                this.setCodeMirror().setToolbar().loadedDisplay()) : this.loadQueues(),
                this
            },
            loadQueues: function() {
                var e = this
                  , t = this.settings
                  , i = t.path
                  , r = function() {
                    o.isIE8 ? e.loadedDisplay() : t.flowChart || t.sequenceDiagram ? o.loadScript(i + "raphael.min", function() {
                        o.loadScript(i + "underscore.min", function() {
                            !t.flowChart && t.sequenceDiagram ? o.loadScript(i + "sequence-diagram.min", function() {
                                e.loadedDisplay()
                            }) : t.flowChart && !t.sequenceDiagram ? o.loadScript(i + "flowchart.min", function() {
                                o.loadScript(i + "jquery.flowchart.min", function() {
                                    e.loadedDisplay()
                                })
                            }) : t.flowChart && t.sequenceDiagram && o.loadScript(i + "flowchart.min", function() {
                                o.loadScript(i + "jquery.flowchart.min", function() {
                                    o.loadScript(i + "sequence-diagram.min", function() {
                                        e.loadedDisplay()
                                    })
                                })
                            })
                        })
                    }) : e.loadedDisplay()
                };
                return o.loadCSS(i + "codemirror/codemirror.min"),
                t.searchReplace && !t.readOnly && (o.loadCSS(i + "codemirror/addon/dialog/dialog"),
                o.loadCSS(i + "codemirror/addon/search/matchesonscrollbar")),
                t.codeFold && o.loadCSS(i + "codemirror/addon/fold/foldgutter"),
                o.loadScript(i + "codemirror/codemirror.min", function() {
                    o.$CodeMirror = CodeMirror,
                    o.loadScript(i + "codemirror/modes.min", function() {
                        o.loadScript(i + "codemirror/addons.min", function() {
                            if (e.setCodeMirror(),
                            "gfm" !== t.mode && "markdown" !== t.mode)
                                return e.loadedDisplay(),
                                !1;
                            e.setToolbar(),
                            o.loadScript(i + "marked.min", function() {
                                o.$marked = marked,
                                t.previewCodeHighlight ? o.loadScript(i + "prettify.min", function() {
                                    r()
                                }) : r()
                            })
                        })
                    })
                }),
                this
            },
            setTheme: function(e) {
                var t = this.editor
                  , i = this.settings.theme
                  , o = this.classPrefix + "theme-";
                return t.removeClass(o + i).addClass(o + e),
                this.settings.theme = e,
                this
            },
            setEditorTheme: function(e) {
                var t = this.settings;
                return t.editorTheme = e,
                "default" !== e && o.loadCSS(t.path + "codemirror/theme/" + t.editorTheme),
                this.cm.setOption("theme", e),
                this
            },
            setCodeMirrorTheme: function(e) {
                return this.setEditorTheme(e),
                this
            },
            setPreviewTheme: function(e) {
                var t = this.preview
                  , i = this.settings.previewTheme
                  , o = this.classPrefix + "preview-theme-";
                return t.removeClass(o + i).addClass(o + e),
                this.settings.previewTheme = e,
                this
            },
            setCodeMirror: function() {
                var e = this.settings
                  , t = this.editor;
                "default" !== e.editorTheme && o.loadCSS(e.path + "codemirror/theme/" + e.editorTheme);
                var i = {
                    mode: e.mode,
                    theme: e.editorTheme,
                    tabSize: e.tabSize,
                    dragDrop: !1,
                    autofocus: e.autoFocus,
                    autoCloseTags: e.autoCloseTags,
                    readOnly: !!e.readOnly && "nocursor",
                    indentUnit: e.indentUnit,
                    lineNumbers: e.lineNumbers,
                    lineWrapping: e.lineWrapping,
                    extraKeys: {
                        "Ctrl-Q": function(e) {
                            e.foldCode(e.getCursor())
                        }
                    },
                    foldGutter: e.codeFold,
                    gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
                    matchBrackets: e.matchBrackets,
                    indentWithTabs: e.indentWithTabs,
                    styleActiveLine: e.styleActiveLine,
                    styleSelectedText: e.styleSelectedText,
                    autoCloseBrackets: e.autoCloseBrackets,
                    showTrailingSpace: e.showTrailingSpace,
                    highlightSelectionMatches: !!e.matchWordHighlight && {
                        showToken: "onselected" !== e.matchWordHighlight && /\w/
                    }
                };
                return this.codeEditor = this.cm = o.$CodeMirror.fromTextArea(this.markdownTextarea[0], i),
                this.codeMirror = this.cmElement = t.children(".CodeMirror"),
                "" !== e.value && this.cm.setValue(e.value),
                this.codeMirror.css({
                    fontSize: e.fontSize,
                    width: e.watch ? "50%" : "100%"
                }),
                e.autoHeight && (this.codeMirror.css("height", "auto"),
                this.cm.setOption("viewportMargin", 1 / 0)),
                e.lineNumbers || this.codeMirror.find(".CodeMirror-gutters").css("border-right", "none"),
                this
            },
            getCodeMirrorOption: function(e) {
                return this.cm.getOption(e)
            },
            setCodeMirrorOption: function(e, t) {
                return this.cm.setOption(e, t),
                this
            },
            addKeyMap: function(e, t) {
                return this.cm.addKeyMap(e, t),
                this
            },
            removeKeyMap: function(e) {
                return this.cm.removeKeyMap(e),
                this
            },
            gotoLine: function(t) {
                var i = this.settings;
                if (!i.gotoLine)
                    return this;
                var o = this.cm
                  , r = (this.editor,
                o.lineCount())
                  , n = this.preview;
                if ("string" == typeof t && ("last" === t && (t = r),
                "first" === t && (t = 1)),
                "number" != typeof t)
                    return alert("Error: The line number must be an integer."),
                    this;
                if ((t = parseInt(t) - 1) > r)
                    return alert("Error: The line number range 1-" + r),
                    this;
                o.setCursor({
                    line: t,
                    ch: 0
                });
                var a = o.getScrollInfo().clientHeight
                  , s = o.charCoords({
                    line: t,
                    ch: 0
                }, "local");
                if (o.scrollTo(null, (s.top + s.bottom - a) / 2),
                i.watch) {
                    var l = this.codeMirror.find(".CodeMirror-scroll")[0]
                      , c = e(l).height()
                      , h = l.scrollTop
                      , d = h / l.scrollHeight;
                    0 === h ? n.scrollTop(0) : h + c >= l.scrollHeight - 16 ? n.scrollTop(n[0].scrollHeight) : n.scrollTop(n[0].scrollHeight * d)
                }
                return o.focus(),
                this
            },
            extend: function() {
                return void 0 !== arguments[1] && ("function" == typeof arguments[1] && (arguments[1] = e.proxy(arguments[1], this)),
                this[arguments[0]] = arguments[1]),
                "object" == typeof arguments[0] && void 0 === arguments[0].length && e.extend(!0, this, arguments[0]),
                this
            },
            set: function(t, i) {
                return void 0 !== i && "function" == typeof i && (i = e.proxy(i, this)),
                this[t] = i,
                this
            },
            config: function(t, i) {
                var o = this.settings;
                return "object" == typeof t && (o = e.extend(!0, o, t)),
                "string" == typeof t && (o[t] = i),
                this.settings = o,
                this.recreate(),
                this
            },
            on: function(t, i) {
                var o = this.settings;
                return void 0 !== o["on" + t] && (o["on" + t] = e.proxy(i, this)),
                this
            },
            off: function(e) {
                var t = this.settings;
                return void 0 !== t["on" + e] && (t["on" + e] = function() {}
                ),
                this
            },
            showToolbar: function(t) {
                var i = this.settings;
                return i.readOnly ? this : (i.toolbar && (this.toolbar.length < 1 || "" === this.toolbar.find("." + this.classPrefix + "menu").html()) && this.setToolbar(),
                i.toolbar = !0,
                this.toolbar.show(),
                this.resize(),
                e.proxy(t || function() {}
                , this)(),
                this)
            },
            hideToolbar: function(t) {
                return this.settings.toolbar = !1,
                this.toolbar.hide(),
                this.resize(),
                e.proxy(t || function() {}
                , this)(),
                this
            },
            setToolbarAutoFixed: function(t) {
                var i = this.state
                  , o = this.editor
                  , r = this.toolbar
                  , n = this.settings;
                void 0 !== t && (n.toolbarAutoFixed = t);
                return !i.fullscreen && !i.preview && n.toolbar && n.toolbarAutoFixed && e(window).bind("scroll", function() {
                    var t = e(window)
                      , i = t.scrollTop();
                    if (!n.toolbarAutoFixed)
                        return !1;
                    i - o.offset().top > 10 && i < o.height() ? r.css({
                        position: "fixed",
                        width: o.width() + "px",
                        left: (t.width() - o.width()) / 2 + "px"
                    }) : r.css({
                        position: "absolute",
                        width: "100%",
                        left: 0
                    })
                }),
                this
            },
            setToolbar: function() {
                var e = this.settings;
                if (e.readOnly)
                    return this;
                var t = this.editor
                  , i = (this.preview,
                this.classPrefix)
                  , r = this.toolbar = t.children("." + i + "toolbar");
                if (e.toolbar && r.length < 1) {
                    var n = '<div class="' + i + 'toolbar"><div class="' + i + 'toolbar-container"><ul class="' + i + 'menu"></ul></div></div>';
                    t.append(n),
                    r = this.toolbar = t.children("." + i + "toolbar")
                }
                if (!e.toolbar)
                    return r.hide(),
                    this;
                r.show();
                for (var a = "function" == typeof e.toolbarIcons ? e.toolbarIcons() : "string" == typeof e.toolbarIcons ? o.toolbarModes[e.toolbarIcons] : e.toolbarIcons, s = r.find("." + this.classPrefix + "menu"), l = "", c = !1, h = 0, d = a.length; h < d; h++) {
                    var u = a[h];
                    if ("||" === u)
                        c = !0;
                    else if ("|" === u)
                        l += '<li class="divider" unselectable="on">|</li>';
                    else {
                        var f = /h(\d)/.test(u)
                          , g = u;
                        "watch" !== u || e.watch || (g = "unwatch");
                        var p = e.lang.toolbar[g]
                          , m = e.toolbarIconTexts[g]
                          , w = e.toolbarIconsClass[g];
                        p = void 0 === p ? "" : p,
                        m = void 0 === m ? "" : m,
                        w = void 0 === w ? "" : w;
                        var v = c ? '<li class="pull-right">' : "<li>";
                        void 0 !== e.toolbarCustomIcons[u] && "function" != typeof e.toolbarCustomIcons[u] ? v += e.toolbarCustomIcons[u] : (v += '<a href="javascript:;" title="' + p + '" unselectable="on">',
                        v += '<i class="fa ' + w + '" name="' + u + '" unselectable="on">' + (f ? u.toUpperCase() : "" === w ? m : "") + "</i>",
                        v += "</a>"),
                        v += "</li>",
                        l = c ? v + l : l + v
                    }
                }
                return s.html(l),
                s.find('[title="Lowercase"]').attr("title", e.lang.toolbar.lowercase),
                s.find('[title="ucwords"]').attr("title", e.lang.toolbar.ucwords),
                this.setToolbarHandler(),
                this.setToolbarAutoFixed(),
                this
            },
            dialogLockScreen: function() {
                return e.proxy(o.dialogLockScreen, this)(),
                this
            },
            dialogShowMask: function(t) {
                return e.proxy(o.dialogShowMask, this)(t),
                this
            },
            getToolbarHandles: function(e) {
                var t = this.toolbarHandlers = o.toolbarHandlers;
                return e && void 0 !== toolbarIconHandlers[e] ? t[e] : t
            },
            setToolbarHandler: function() {
                var t = this
                  , i = this.settings;
                if (!i.toolbar || i.readOnly)
                    return this;
                var r = this.toolbar
                  , n = this.cm
                  , a = this.classPrefix
                  , s = this.toolbarIcons = r.find("." + a + "menu > li > a")
                  , l = this.getToolbarHandles();
                return s.bind(o.mouseOrTouch("click", "touchend"), function(o) {
                    var r = e(this).children(".fa")
                      , a = r.attr("name")
                      , s = n.getCursor()
                      , c = n.getSelection();
                    if ("" !== a)
                        return t.activeIcon = r,
                        void 0 !== l[a] ? e.proxy(l[a], t)(n) : void 0 !== i.toolbarHandlers[a] && e.proxy(i.toolbarHandlers[a], t)(n, r, s, c),
                        "link" !== a && "reference-link" !== a && "image" !== a && "code-block" !== a && "preformatted-text" !== a && "watch" !== a && "preview" !== a && "search" !== a && "fullscreen" !== a && "info" !== a && n.focus(),
                        !1
                }),
                this
            },
            createDialog: function(t) {
                return e.proxy(o.createDialog, this)(t)
            },
            createInfoDialog: function() {
                var e = this
                  , t = this.editor
                  , i = this.classPrefix
                  , r = ['<div class="' + i + "dialog " + i + 'dialog-info" style="">', '<div class="' + i + 'dialog-container">', '<h1><i class="editormd-logo editormd-logo-lg editormd-logo-color"></i> ' + o.title + "<small>v" + o.version + "</small></h1>", "<p>" + this.lang.description + "</p>", '<p style="margin: 10px 0 20px 0;"><a href="' + o.homePage + '" target="_blank">' + o.homePage + ' <i class="fa fa-external-link"></i></a></p>', '<p style="font-size: 0.85em;">Copyright &copy; 2015 <a href="https://github.com/pandao" target="_blank" class="hover-link">Pandao</a>, The <a href="https://github.com/pandao/editor.md/blob/master/LICENSE" target="_blank" class="hover-link">MIT</a> License.</p>', "</div>", '<a href="javascript:;" class="fa fa-close ' + i + 'dialog-close"></a>', "</div>"].join("\n");
                t.append(r);
                var n = this.infoDialog = t.children("." + i + "dialog-info");
                return n.find("." + i + "dialog-close").bind(o.mouseOrTouch("click", "touchend"), function() {
                    e.hideInfoDialog()
                }),
                n.css("border", o.isIE8 ? "1px solid #ddd" : "").css("z-index", o.dialogZindex).show(),
                this.infoDialogPosition(),
                this
            },
            infoDialogPosition: function() {
                var t = this.infoDialog
                  , i = function() {
                    t.css({
                        top: (e(window).height() - t.height()) / 2 + "px",
                        left: (e(window).width() - t.width()) / 2 + "px"
                    })
                };
                return i(),
                e(window).resize(i),
                this
            },
            showInfoDialog: function() {
                e("html,body").css("overflow-x", "hidden");
                var t = this.editor
                  , i = this.settings
                  , r = this.infoDialog = t.children("." + this.classPrefix + "dialog-info");
                return r.length < 1 && this.createInfoDialog(),
                this.lockScreen(!0),
                this.mask.css({
                    opacity: i.dialogMaskOpacity,
                    backgroundColor: i.dialogMaskBgColor
                }).show(),
                r.css("z-index", o.dialogZindex).show(),
                this.infoDialogPosition(),
                this
            },
            hideInfoDialog: function() {
                return e("html,body").css("overflow-x", ""),
                this.infoDialog.hide(),
                this.mask.hide(),
                this.lockScreen(!1),
                this
            },
            lockScreen: function(e) {
                return o.lockScreen(e),
                this.resize(),
                this
            },
            recreate: function() {
                var e = this.editor
                  , t = this.settings;
                return this.codeMirror.remove(),
                this.setCodeMirror(),
                t.readOnly || (e.find(".editormd-dialog").length > 0 && e.find(".editormd-dialog").remove(),
                t.toolbar && (this.getToolbarHandles(),
                this.setToolbar())),
                this.loadedDisplay(!0),
                this
            },
            previewCodeHighlight: function() {
                var e = this.settings
                  , t = this.previewContainer;
                return e.previewCodeHighlight && (t.find("pre").addClass("prettyprint"),
                "undefined" != typeof prettyPrint && prettyPrint()),
                this
            },
            katexRender: function() {
                return null === t ? this : (this.previewContainer.find("." + o.classNames.tex).each(function() {
                    var t = e(this);
                    o.$katex.render(t.text(), t[0]),
                    t.find(".katex").css("font-size", "1.6em")
                }),
                this)
            },
            flowChartAndSequenceDiagramRender: function() {
                var t = this.settings
                  , r = this.previewContainer;
                if (o.isIE8)
                    return this;
                if (t.flowChart) {
                    if (null === i)
                        return this;
                    r.find(".flowchart").flowChart()
                }
                t.sequenceDiagram && r.find(".sequence-diagram").sequenceDiagram({
                    theme: "simple"
                });
                var n = this.preview
                  , a = this.codeMirror.find(".CodeMirror-scroll")
                  , s = a.height()
                  , l = a.scrollTop()
                  , c = l / a[0].scrollHeight
                  , h = 0;
                n.find(".markdown-toc-list").each(function() {
                    h += e(this).height()
                });
                var d = n.find(".editormd-toc-menu").height();
                return d = d || 0,
                0 === l ? n.scrollTop(0) : l + s >= a[0].scrollHeight - 16 ? n.scrollTop(n[0].scrollHeight) : n.scrollTop((n[0].scrollHeight + h + d) * c),
                this
            },
            registerKeyMaps: function(t) {
                var i = this
                  , r = this.cm
                  , n = this.settings
                  , a = o.toolbarHandlers
                  , s = n.disabledKeyMaps;
                if (t = t || null) {
                    for (var l in t)
                        if (e.inArray(l, s) < 0) {
                            t[l],
                            r.addKeyMap(t)
                        }
                } else {
                    for (var c in o.keyMaps) {
                        var h = o.keyMaps[c]
                          , d = "string" == typeof h ? e.proxy(a[h], i) : e.proxy(h, i);
                        if (e.inArray(c, ["F9", "F10", "F11"]) < 0 && e.inArray(c, s) < 0) {
                            var u = {};
                            u[c] = d,
                            r.addKeyMap(u)
                        }
                    }
                    e(window).keydown(function(t) {
                        if (e.inArray({
                            120: "F9",
                            121: "F10",
                            122: "F11"
                        }[t.keyCode], s) < 0)
                            switch (t.keyCode) {
                            case 120:
                                return e.proxy(a.watch, i)(),
                                !1;
                            case 121:
                                return e.proxy(a.preview, i)(),
                                !1;
                            case 122:
                                return e.proxy(a.fullscreen, i)(),
                                !1
                            }
                    })
                }
                return this
            },
            bindScrollEvent: function() {
                var t = this
                  , i = this.preview
                  , r = this.settings
                  , n = this.codeMirror
                  , a = o.mouseOrTouch;
                if (!r.syncScrolling)
                    return this;
                var s = function() {
                    n.find(".CodeMirror-scroll").bind(a("scroll", "touchmove"), function(o) {
                        var n = e(this).height()
                          , a = e(this).scrollTop()
                          , s = a / e(this)[0].scrollHeight
                          , l = 0;
                        i.find(".markdown-toc-list").each(function() {
                            l += e(this).height()
                        });
                        var c = i.find(".editormd-toc-menu").height();
                        c = c || 0,
                        0 === a ? i.scrollTop(0) : a + n >= e(this)[0].scrollHeight - 16 ? i.scrollTop(i[0].scrollHeight) : i.scrollTop((i[0].scrollHeight + l + c) * s),
                        e.proxy(r.onscroll, t)(o)
                    })
                }
                  , l = function() {
                    n.find(".CodeMirror-scroll").unbind(a("scroll", "touchmove"))
                }
                  , c = function() {
                    i.bind(a("scroll", "touchmove"), function(i) {
                        var o = e(this).height()
                          , a = e(this).scrollTop()
                          , s = a / e(this)[0].scrollHeight
                          , l = n.find(".CodeMirror-scroll");
                        0 === a ? l.scrollTop(0) : a + o >= e(this)[0].scrollHeight ? l.scrollTop(l[0].scrollHeight) : l.scrollTop(l[0].scrollHeight * s),
                        e.proxy(r.onpreviewscroll, t)(i)
                    })
                }
                  , h = function() {
                    i.unbind(a("scroll", "touchmove"))
                };
                return n.bind({
                    mouseover: s,
                    mouseout: l,
                    touchstart: s,
                    touchend: l
                }),
                "single" === r.syncScrolling ? this : (i.bind({
                    mouseover: c,
                    mouseout: h,
                    touchstart: c,
                    touchend: h
                }),
                this)
            },
            bindChangeEvent: function() {
                var e = this
                  , i = this.cm
                  , o = this.settings;
                return o.syncScrolling ? (i.on("change", function(i, r) {
                    o.watch && e.previewContainer.css("padding", o.autoHeight ? "20px 20px 50px 40px" : "20px"),
                    t = setTimeout(function() {
                        clearTimeout(t),
                        e.save(),
                        t = null
                    }, o.delay)
                }),
                this) : this
            },
            loadedDisplay: function(t) {
                t = t || !1;
                var i = this
                  , o = this.editor
                  , r = this.preview
                  , n = this.settings;
                return this.containerMask.hide(),
                this.save(),
                n.watch && r.show(),
                o.data("oldWidth", o.width()).data("oldHeight", o.height()),
                this.resize(),
                this.registerKeyMaps(),
                e(window).resize(function() {
                    i.resize()
                }),
                this.bindScrollEvent().bindChangeEvent(),
                t || e.proxy(n.onload, this)(),
                this.state.loaded = !0,
                this
            },
            width: function(e) {
                return this.editor.css("width", "number" == typeof e ? e + "px" : e),
                this.resize(),
                this
            },
            height: function(e) {
                return this.editor.css("height", "number" == typeof e ? e + "px" : e),
                this.resize(),
                this
            },
            resize: function(t, i) {
                t = t || null,
                i = i || null;
                var o = this.state
                  , r = this.editor
                  , n = this.preview
                  , a = this.toolbar
                  , s = this.settings
                  , l = this.codeMirror;
                if (t && r.css("width", "number" == typeof t ? t + "px" : t),
                !s.autoHeight || o.fullscreen || o.preview ? (i && r.css("height", "number" == typeof i ? i + "px" : i),
                o.fullscreen && r.height(e(window).height()),
                s.toolbar && !s.readOnly ? l.css("margin-top", a.height() + 1).height(r.height() - a.height()) : l.css("margin-top", 0).height(r.height())) : (r.css("height", "auto"),
                l.css("height", "auto")),
                s.watch)
                    if (l.width(r.width() / 2),
                    n.width(o.preview ? r.width() : r.width() / 2),
                    this.previewContainer.css("padding", s.autoHeight ? "20px 20px 50px 40px" : "20px"),
                    s.toolbar && !s.readOnly ? n.css("top", a.height() + 1) : n.css("top", 0),
                    !s.autoHeight || o.fullscreen || o.preview) {
                        var c = s.toolbar && !s.readOnly ? r.height() - a.height() : r.height();
                        n.height(c)
                    } else
                        n.height("");
                else
                    l.width(r.width()),
                    n.hide();
                return o.loaded && e.proxy(s.onresize, this)(),
                this
            },
            save: function() {
                var r = this
                  , n = this.state
                  , a = this.settings;
                if (null === t && (a.watch || !n.preview))
                    return this;
                var s = this.cm
                  , l = s.getValue()
                  , c = this.previewContainer;
                if ("gfm" !== a.mode && "markdown" !== a.mode)
                    return this.markdownTextarea.val(l),
                    this;
                var h = o.$marked
                  , d = this.markdownToC = []
                  , u = this.markedRendererOptions = {
                    toc: a.toc,
                    tocm: a.tocm,
                    tocStartLevel: a.tocStartLevel,
                    pageBreak: a.pageBreak,
                    taskList: a.taskList,
                    emoji: a.emoji,
                    tex: a.tex,
                    atLink: a.atLink,
                    emailLink: a.emailLink,
                    flowChart: a.flowChart,
                    sequenceDiagram: a.sequenceDiagram,
                    previewCodeHighlight: a.previewCodeHighlight
                }
                  , f = this.markedOptions = {
                    renderer: o.markedRenderer(d, u),
                    gfm: !0,
                    tables: !0,
                    breaks: !0,
                    pedantic: !1,
                    sanitize: !a.htmlDecode,
                    smartLists: !0,
                    smartypants: !0
                };
                h.setOptions(f);
                var g = o.$marked(l, f);
                if (g = o.filterHTMLTags(g, a.htmlDecode),
                this.markdownTextarea.text(l),
                s.save(),
                a.saveHTMLToTextarea && this.htmlTextarea.text(g),
                a.watch || !a.watch && n.preview) {
                    if (c.html(g),
                    this.previewCodeHighlight(),
                    a.toc) {
                        var p = "" === a.tocContainer ? c : e(a.tocContainer)
                          , m = p.find("." + this.classPrefix + "toc-menu");
                        p.attr("previewContainer", "" === a.tocContainer ? "true" : "false"),
                        "" !== a.tocContainer && m.length > 0 && m.remove(),
                        o.markdownToCRenderer(d, p, a.tocDropdown, a.tocStartLevel),
                        (a.tocDropdown || p.find("." + this.classPrefix + "toc-menu").length > 0) && o.tocDropdownMenu(p, "" !== a.tocTitle ? a.tocTitle : this.lang.tocTitle),
                        "" !== a.tocContainer && c.find(".markdown-toc").css("border", "none")
                    }
                    a.tex && (!o.kaTeXLoaded && a.autoLoadModules ? o.loadKaTeX(function() {
                        o.$katex = katex,
                        o.kaTeXLoaded = !0,
                        r.katexRender()
                    }) : (o.$katex = katex,
                    this.katexRender())),
                    (a.flowChart || a.sequenceDiagram) && (i = setTimeout(function() {
                        clearTimeout(i),
                        r.flowChartAndSequenceDiagramRender(),
                        i = null
                    }, 10)),
                    n.loaded && e.proxy(a.onchange, this)()
                }
                return this
            },
            focus: function() {
                return this.cm.focus(),
                this
            },
            setCursor: function(e) {
                return this.cm.setCursor(e),
                this
            },
            getCursor: function() {
                return this.cm.getCursor()
            },
            setSelection: function(e, t) {
                return this.cm.setSelection(e, t),
                this
            },
            getSelection: function() {
                return this.cm.getSelection()
            },
            setSelections: function(e) {
                return this.cm.setSelections(e),
                this
            },
            getSelections: function() {
                return this.cm.getSelections()
            },
            replaceSelection: function(e) {
                return this.cm.replaceSelection(e),
                this
            },
            insertValue: function(e) {
                return this.replaceSelection(e),
                this
            },
            appendMarkdown: function(e) {
                this.settings;
                var t = this.cm;
                return t.setValue(t.getValue() + e),
                this
            },
            setMarkdown: function(e) {
                return this.cm.setValue(e || this.settings.markdown),
                this
            },
            getMarkdown: function() {
                return this.cm.getValue()
            },
            getValue: function() {
                return this.cm.getValue()
            },
            setValue: function(e) {
                return this.cm.setValue(e),
                this
            },
            clear: function() {
                return this.cm.setValue(""),
                this
            },
            getHTML: function() {
                return this.settings.saveHTMLToTextarea ? this.htmlTextarea.val() : (alert("Error: settings.saveHTMLToTextarea == false"),
                !1)
            },
            getTextareaSavedHTML: function() {
                return this.getHTML()
            },
            getPreviewedHTML: function() {
                return this.settings.watch ? this.previewContainer.html() : (alert("Error: settings.watch == false"),
                !1)
            },
            watch: function(i) {
                var o = this.settings;
                if (e.inArray(o.mode, ["gfm", "markdown"]) < 0)
                    return this;
                if (this.state.watching = o.watch = !0,
                this.preview.show(),
                this.toolbar) {
                    var r = o.toolbarIconsClass.watch
                      , n = o.toolbarIconsClass.unwatch
                      , a = this.toolbar.find(".fa[name=watch]");
                    a.parent().attr("title", o.lang.toolbar.watch),
                    a.removeClass(n).addClass(r)
                }
                return this.codeMirror.css("border-right", "1px solid #ddd").width(this.editor.width() / 2),
                t = 0,
                this.save().resize(),
                o.onwatch || (o.onwatch = i || function() {}
                ),
                e.proxy(o.onwatch, this)(),
                this
            },
            unwatch: function(t) {
                var i = this.settings;
                if (this.state.watching = i.watch = !1,
                this.preview.hide(),
                this.toolbar) {
                    var o = i.toolbarIconsClass.watch
                      , r = i.toolbarIconsClass.unwatch
                      , n = this.toolbar.find(".fa[name=watch]");
                    n.parent().attr("title", i.lang.toolbar.unwatch),
                    n.removeClass(o).addClass(r)
                }
                return this.codeMirror.css("border-right", "none").width(this.editor.width()),
                this.resize(),
                i.onunwatch || (i.onunwatch = t || function() {}
                ),
                e.proxy(i.onunwatch, this)(),
                this
            },
            show: function(t) {
                t = t || function() {}
                ;
                var i = this;
                return this.editor.show(0, function() {
                    e.proxy(t, i)()
                }),
                this
            },
            hide: function(t) {
                t = t || function() {}
                ;
                var i = this;
                return this.editor.hide(0, function() {
                    e.proxy(t, i)()
                }),
                this
            },
            previewing: function() {
                var t = this
                  , i = this.editor
                  , r = this.preview
                  , n = this.toolbar
                  , a = this.settings
                  , s = this.codeMirror
                  , l = this.previewContainer;
                if (e.inArray(a.mode, ["gfm", "markdown"]) < 0)
                    return this;
                a.toolbar && n && (n.toggle(),
                n.find(".fa[name=preview]").toggleClass("active")),
                s.toggle();
                var c = function(e) {
                    e.shiftKey && 27 === e.keyCode && t.previewed()
                };
                "none" === s.css("display") ? (this.state.preview = !0,
                this.state.fullscreen && r.css("background", "#fff"),
                i.find("." + this.classPrefix + "preview-close-btn").show().bind(o.mouseOrTouch("click", "touchend"), function() {
                    t.previewed()
                }),
                a.watch ? l.css("padding", "") : this.save(),
                l.addClass(this.classPrefix + "preview-active"),
                r.show().css({
                    position: "",
                    top: 0,
                    width: i.width(),
                    height: a.autoHeight && !this.state.fullscreen ? "auto" : i.height()
                }),
                this.state.loaded && e.proxy(a.onpreviewing, this)(),
                e(window).bind("keyup", c)) : (e(window).unbind("keyup", c),
                this.previewed())
            },
            previewed: function() {
                var t = this.editor
                  , i = this.preview
                  , r = this.toolbar
                  , n = this.settings
                  , a = this.previewContainer
                  , s = t.find("." + this.classPrefix + "preview-close-btn");
                return this.state.preview = !1,
                this.codeMirror.show(),
                n.toolbar && r.show(),
                i[n.watch ? "show" : "hide"](),
                s.hide().unbind(o.mouseOrTouch("click", "touchend")),
                a.removeClass(this.classPrefix + "preview-active"),
                n.watch && a.css("padding", "20px"),
                i.css({
                    background: null,
                    position: "absolute",
                    width: t.width() / 2,
                    height: n.autoHeight && !this.state.fullscreen ? "auto" : t.height() - r.height(),
                    top: n.toolbar ? r.height() : 0
                }),
                this.state.loaded && e.proxy(n.onpreviewed, this)(),
                this
            },
            fullscreen: function() {
                var t = this
                  , i = this.state
                  , o = this.editor
                  , r = (this.preview,
                this.toolbar)
                  , n = this.settings
                  , a = this.classPrefix + "fullscreen";
                r && r.find(".fa[name=fullscreen]").parent().toggleClass("active");
                var s = function(e) {
                    e.shiftKey || 27 !== e.keyCode || i.fullscreen && t.fullscreenExit()
                };
                return o.hasClass(a) ? (e(window).unbind("keyup", s),
                this.fullscreenExit()) : (i.fullscreen = !0,
                e("html,body").css("overflow", "hidden"),
                o.css({
                    width: e(window).width(),
                    height: e(window).height()
                }).addClass(a),
                this.resize(),
                e.proxy(n.onfullscreen, this)(),
                e(window).bind("keyup", s)),
                this
            },
            fullscreenExit: function() {
                var t = this.editor
                  , i = this.settings
                  , o = this.toolbar
                  , r = this.classPrefix + "fullscreen";
                return this.state.fullscreen = !1,
                o && o.find(".fa[name=fullscreen]").parent().removeClass("active"),
                e("html,body").css("overflow", ""),
                t.css({
                    width: t.data("oldWidth"),
                    height: t.data("oldHeight")
                }).removeClass(r),
                this.resize(),
                e.proxy(i.onfullscreenExit, this)(),
                this
            },
            executePlugin: function(t, i) {
                var r = this
                  , n = this.cm;
                return i = this.settings.pluginPath + i,
                "function" == typeof define ? void 0 === this[t] ? (alert("Error: " + t + " plugin is not found, you are not load this plugin."),
                this) : (this[t](n),
                this) : (e.inArray(i, o.loadFiles.plugin) < 0 ? o.loadPlugin(i, function() {
                    o.loadPlugins[t] = r[t],
                    r[t](n)
                }) : e.proxy(o.loadPlugins[t], this)(n),
                this)
            },
            search: function(e) {
                var t = this.settings;
                return t.searchReplace ? (t.readOnly || this.cm.execCommand(e || "find"),
                this) : (alert("Error: settings.searchReplace == false"),
                this)
            },
            searchReplace: function() {
                return this.search("replace"),
                this
            },
            searchReplaceAll: function() {
                return this.search("replaceAll"),
                this
            }
        },
        o.fn.init.prototype = o.fn,
        o.dialogLockScreen = function() {
            (this.settings || {
                dialogLockScreen: !0
            }).dialogLockScreen && (e("html,body").css("overflow", "hidden"),
            this.resize())
        }
        ,
        o.dialogShowMask = function(t) {
            var i = this.editor
              , o = this.settings || {
                dialogShowMask: !0
            };
            t.css({
                top: (e(window).height() - t.height()) / 2 + "px",
                left: (e(window).width() - t.width()) / 2 + "px"
            }),
            o.dialogShowMask && i.children("." + this.classPrefix + "mask").css("z-index", parseInt(t.css("z-index")) - 1).show()
        }
        ,
        o.toolbarHandlers = {
            undo: function() {
                this.cm.undo()
            },
            redo: function() {
                this.cm.redo()
            },
            bold: function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                e.replaceSelection("**" + i + "**"),
                "" === i && e.setCursor(t.line, t.ch + 2)
            },
            del: function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                e.replaceSelection("~~" + i + "~~"),
                "" === i && e.setCursor(t.line, t.ch + 2)
            },
            italic: function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                e.replaceSelection("*" + i + "*"),
                "" === i && e.setCursor(t.line, t.ch + 1)
            },
            quote: function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                0 !== t.ch ? (e.setCursor(t.line, 0),
                e.replaceSelection("> " + i),
                e.setCursor(t.line, t.ch + 2)) : e.replaceSelection("> " + i)
            },
            ucfirst: function() {
                var e = this.cm
                  , t = e.getSelection()
                  , i = e.listSelections();
                e.replaceSelection(o.firstUpperCase(t)),
                e.setSelections(i)
            },
            ucwords: function() {
                var e = this.cm
                  , t = e.getSelection()
                  , i = e.listSelections();
                e.replaceSelection(o.wordsFirstUpperCase(t)),
                e.setSelections(i)
            },
            uppercase: function() {
                var e = this.cm
                  , t = e.getSelection()
                  , i = e.listSelections();
                e.replaceSelection(t.toUpperCase()),
                e.setSelections(i)
            },
            lowercase: function() {
                var e = this.cm
                  , t = (e.getCursor(),
                e.getSelection())
                  , i = e.listSelections();
                e.replaceSelection(t.toLowerCase()),
                e.setSelections(i)
            },
            h1: function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                0 !== t.ch ? (e.setCursor(t.line, 0),
                e.replaceSelection("# " + i),
                e.setCursor(t.line, t.ch + 2)) : e.replaceSelection("# " + i)
            },
            h2: function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                0 !== t.ch ? (e.setCursor(t.line, 0),
                e.replaceSelection("## " + i),
                e.setCursor(t.line, t.ch + 3)) : e.replaceSelection("## " + i)
            },
            h3: function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                0 !== t.ch ? (e.setCursor(t.line, 0),
                e.replaceSelection("### " + i),
                e.setCursor(t.line, t.ch + 4)) : e.replaceSelection("### " + i)
            },
            h4: function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                0 !== t.ch ? (e.setCursor(t.line, 0),
                e.replaceSelection("#### " + i),
                e.setCursor(t.line, t.ch + 5)) : e.replaceSelection("#### " + i)
            },
            h5: function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                0 !== t.ch ? (e.setCursor(t.line, 0),
                e.replaceSelection("##### " + i),
                e.setCursor(t.line, t.ch + 6)) : e.replaceSelection("##### " + i)
            },
            h6: function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                0 !== t.ch ? (e.setCursor(t.line, 0),
                e.replaceSelection("###### " + i),
                e.setCursor(t.line, t.ch + 7)) : e.replaceSelection("###### " + i)
            },
            "list-ul": function() {
                var e = this.cm
                  , t = (e.getCursor(),
                e.getSelection());
                if ("" === t)
                    e.replaceSelection("- " + t);
                else {
                    for (var i = t.split("\n"), o = 0, r = i.length; o < r; o++)
                        i[o] = "" === i[o] ? "" : "- " + i[o];
                    e.replaceSelection(i.join("\n"))
                }
            },
            "list-ol": function() {
                var e = this.cm
                  , t = (e.getCursor(),
                e.getSelection());
                if ("" === t)
                    e.replaceSelection("1. " + t);
                else {
                    for (var i = t.split("\n"), o = 0, r = i.length; o < r; o++)
                        i[o] = "" === i[o] ? "" : o + 1 + ". " + i[o];
                    e.replaceSelection(i.join("\n"))
                }
            },
            hr: function() {
                var e = this.cm
                  , t = e.getCursor();
                e.getSelection();
                e.replaceSelection((0 !== t.ch ? "\n\n" : "\n") + "------------\n\n")
            },
            tex: function() {
                if (!this.settings.tex)
                    return alert("settings.tex === false"),
                    this;
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                e.replaceSelection("$$" + i + "$$"),
                "" === i && e.setCursor(t.line, t.ch + 2)
            },
            link: function() {
                this.executePlugin("linkDialog", "link-dialog/link-dialog")
            },
            "reference-link": function() {
                this.executePlugin("referenceLinkDialog", "reference-link-dialog/reference-link-dialog")
            },
            pagebreak: function() {
                if (!this.settings.pageBreak)
                    return alert("settings.pageBreak === false"),
                    this;
                var e = this.cm;
                e.getSelection();
                e.replaceSelection("\r\n[========]\r\n")
            },
            image: function() {
                var t, i = this.cm, o = i.getCursor(), r = i.getSelection();
                e("#image").trigger("click"),
                e("#image").on("change", function(n) {
                    e("#upload_image").submit(function(n) {
                        n.preventDefault(),
                        t || (t = e.ajax({
                            url: "/save",
                            type: "POST",
                            dataType: "JSON",
                            data: new FormData(this),
                            processData: !1,
                            contentType: !1,
                            timeout: 1e4,
                            success: function(t, n) {
                            	// var t = JSON.parse(t);
                                console.log(t),
                                e("#upload_image")[0].reset();
                                var a = t.img[1].replace("public", "https://rongvangit.com/storage")
                                  , s = "![" + t.img[0] + "](" + a + ")";
                                0 !== o.ch ? (i.setCursor(o.line, 0),
                                i.replaceSelection(s + r),
                                i.setCursor(o.line, o.ch + 3)) : i.replaceSelection(s + r)
                            },
                            error: function(e, t, i) {
                                console.log(t,i) 
                            }
                        }))
                    }),
                    e("#upload_image").submit()
                })
            },
            code: function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                e.replaceSelection("`" + i + "`"),
                "" === i && e.setCursor(t.line, t.ch + 1)
            },
            "code-block": function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                e.replaceSelection("```" + i + "\n\n```"),
                "" === i && e.setCursor(t.line, t.ch + 2)
            },
            "preformatted-text": function() {
                this.executePlugin("preformattedTextDialog", "preformatted-text-dialog/preformatted-text-dialog")
            },
            table: function() {
                this.executePlugin("tableDialog", "table-dialog/table-dialog")
            },
            datetime: function() {
                var e = this.cm
                  , t = (e.getSelection(),
                new Date,
                this.settings.lang.name)
                  , i = o.dateFormat() + " " + o.dateFormat("vi-vn" === t || "vi-vn" === t ? "vn-week-day" : "week-day");
                e.replaceSelection(i)
            },
            emoji: function() {
                this.executePlugin("emojiDialog", "emoji-dialog/emoji-dialog")
            },
            "html-entities": function() {
                this.executePlugin("htmlEntitiesDialog", "html-entities-dialog/html-entities-dialog")
            },
            "goto-line": function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                e.replaceSelection('<div class="dinhnghia">' + i + "</div>"),
                "" === i && e.setCursor(t.line, t.ch + 23)
            },
            watch: function() {
                this[this.settings.watch ? "unwatch" : "watch"]()
            },
            preview: function() {
                this.previewing()
            },
            fullscreen: function() {
                this.fullscreen()
            },
            clear: function() {
                this.clear()
            },
            search: function() {
                this.search()
            },
            help: function() {
                this.executePlugin("helpDialog", "help-dialog/help-dialog")
            },
            info: function() {
                this.showInfoDialog()
            }
        },
        o.keyMaps = {
            "Ctrl-1": "h1",
            "Ctrl-2": "h2",
            "Ctrl-3": "h3",
            "Ctrl-4": "h4",
            "Ctrl-5": "h5",
            "Ctrl-6": "h6",
            "Ctrl-B": "bold",
            "Ctrl-D": "datetime",
            "Ctrl-E": function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                this.settings.emoji ? (e.replaceSelection(":" + i + ":"),
                "" === i && e.setCursor(t.line, t.ch + 1)) : alert("Error: settings.emoji == false")
            },
            "Ctrl-Alt-G": "goto-line",
            "Ctrl-H": "hr",
            "Ctrl-I": "italic",
            "Ctrl-K": "code",
            "Ctrl-L": function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection()
                  , o = "" === i ? "" : ' "' + i + '"';
                e.replaceSelection("[" + i + "](" + o + ")"),
                "" === i && e.setCursor(t.line, t.ch + 1)
            },
            "Ctrl-U": "list-ul",
            "Shift-Ctrl-A": function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                this.settings.atLink ? (e.replaceSelection("@" + i),
                "" === i && e.setCursor(t.line, t.ch + 1)) : alert("Error: settings.atLink == false")
            },
            "Shift-Ctrl-C": "code",
            "Shift-Ctrl-Q": "quote",
            "Shift-Ctrl-S": "del",
            "Shift-Ctrl-K": "tex",
            "Shift-Alt-C": function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection();
                e.replaceSelection(["```", i, "```"].join("\n")),
                "" === i && e.setCursor(t.line, t.ch + 3)
            },
            "Shift-Ctrl-Alt-C": "code-block",
            "Shift-Ctrl-H": "html-entities",
            "Shift-Alt-H": "help",
            "Shift-Ctrl-E": "emoji",
            "Shift-Ctrl-U": "uppercase",
            "Shift-Alt-U": "ucwords",
            "Shift-Ctrl-Alt-U": "ucfirst",
            "Shift-Alt-L": "lowercase",
            "Shift-Ctrl-I": function() {
                var e = this.cm
                  , t = e.getCursor()
                  , i = e.getSelection()
                  , o = "" === i ? "" : ' "' + i + '"';
                e.replaceSelection("![" + i + "](" + o + ")"),
                "" === i && e.setCursor(t.line, t.ch + 4)
            },
            "Shift-Ctrl-Alt-I": "image",
            "Shift-Ctrl-L": "link",
            "Shift-Ctrl-O": "list-ol",
            "Shift-Ctrl-P": "preformatted-text",
            "Shift-Ctrl-T": "table",
            "Shift-Alt-P": "pagebreak",
            F9: "watch",
            F10: "preview",
            F11: "fullscreen"
        };
        var r = function(e) {
            return String.prototype.trim ? e.trim() : e.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, "")
        };
        o.trim = r;
        o.ucwords = o.wordsFirstUpperCase = function(e) {
            return e.toLowerCase().replace(/\b(\w)|\s(\w)/g, function(e) {
                return e.toUpperCase()
            })
        }
        ;
        var n = function(e) {
            return e.toLowerCase().replace(/\b(\w)/, function(e) {
                return e.toUpperCase()
            })
        };
        return o.firstUpperCase = o.ucfirst = n,
        o.urls = {
            atLinkBase: "https://github.com/"
        },
        o.regexs = {
            atLink: /@(\w+)/g,
            email: /(\w+)@(\w+)\.(\w+)\.?(\w+)?/g,
            emailLink: /(mailto:)?([\w\.\_]+)@(\w+)\.(\w+)\.?(\w+)?/g,
            emoji: /:([\w\+-]+):/g,
            emojiDatetime: /(\d{2}:\d{2}:\d{2})/g,
            twemoji: /:(tw-([\w]+)-?(\w+)?):/g,
            fontAwesome: /:(fa-([\w]+)(-(\w+)){0,}):/g,
            editormdLogo: /:(editormd-logo-?(\w+)?):/g,
            pageBreak: /^\[[=]{8,}\]$/
        },
        o.emoji = {
            path: "https://www.webfx.com/tools/emoji-cheat-sheet/",
            ext: ".png"
        },
        o.twemoji = {
            path: "http://twemoji.maxcdn.com/36x36/",
            ext: ".png"
        },
        o.markedRenderer = function(t, i) {
            var n = e.extend({
                toc: !0,
                tocm: !1,
                tocStartLevel: 1,
                pageBreak: !0,
                atLink: !0,
                emailLink: !0,
                taskList: !1,
                emoji: !1,
                tex: !1,
                flowChart: !1,
                sequenceDiagram: !1
            }, i || {})
              , a = o.$marked
              , s = new a.Renderer;
            t = t || [];
            var l = o.regexs
              , c = l.atLink
              , h = l.emoji
              , d = l.email
              , u = l.emailLink
              , f = l.twemoji
              , g = l.fontAwesome
              , p = l.editormdLogo
              , m = l.pageBreak;
            return s.emoji = function(e) {
                var t = (e = e.replace(o.regexs.emojiDatetime, function(e) {
                    return e.replace(/:/g, "&#58;")
                })).match(h);
                if (!t || !n.emoji)
                    return e;
                for (var i = 0, r = t.length; i < r; i++)
                    ":+1:" === t[i] && (t[i] = ":\\+1:"),
                    e = e.replace(new RegExp(t[i]), function(e, t) {
                        var i = e.match(g)
                          , r = e.replace(/:/g, "");
                        if (i)
                            for (var n = 0, a = i.length; n < a; n++) {
                                var s = i[n].replace(/:/g, "");
                                return '<i class="fa ' + s + ' fa-emoji" title="' + s.replace("fa-", "") + '"></i>'
                            }
                        else {
                            var l = e.match(p)
                              , c = e.match(f);
                            if (l)
                                for (var h = 0, d = l.length; h < d; h++) {
                                    var u = l[h].replace(/:/g, "");
                                    return '<i class="' + u + '" title="Editor.md logo (' + u + ')"></i>'
                                }
                            else {
                                if (!c) {
                                    var m = "+1" === r ? "plus1" : r;
                                    return m = "moon" === (m = "black_large_square" === m ? "black_square" : m) ? "waxing_gibbous_moon" : m,
                                    '<img src="' + o.emoji.path + m + o.emoji.ext + '" class="emoji" title="&#58;' + r + '&#58;" alt="&#58;' + r + '&#58;" />'
                                }
                                for (var w = 0, v = c.length; w < v; w++) {
                                    var k = c[w].replace(/:/g, "").replace("tw-", "");
                                    return '<img src="' + o.twemoji.path + k + o.twemoji.ext + '" title="twemoji-' + k + '" alt="twemoji-' + k + '" class="emoji twemoji" />'
                                }
                            }
                        }
                    });
                return e
            }
            ,
            s.atLink = function(t) {
                return c.test(t) ? (n.atLink && (t = (t = t.replace(d, function(e, t, i, o) {
                    return e.replace(/@/g, "_#_&#64;_#_")
                })).replace(c, function(e, t) {
                    return '<a href="' + o.urls.atLinkBase + t + '" title="&#64;' + t + '" class="at-link">' + e + "</a>"
                }).replace(/_#_&#64;_#_/g, "@")),
                n.emailLink && (t = t.replace(u, function(t, i, o, r, n) {
                    return !i && e.inArray(n, "jpg|jpeg|png|gif|webp|ico|icon|pdf".split("|")) < 0 ? '<a href="mailto:' + t + '">' + t + "</a>" : t
                })),
                t) : t
            }
            ,
            s.link = function(e, t, i) {
                if (this.options.sanitize) {
                    try {
                        var o = decodeURIComponent(unescape(e)).replace(/[^\w:]/g, "").toLowerCase()
                    } catch (e) {
                        return ""
                    }
                    if (0 === o.indexOf("javascript:"))
                        return ""
                }
                var r = '<a href="' + e + '"';
                return c.test(t) || c.test(i) ? (t && (r += ' title="' + t.replace(/@/g, "&#64;")),
                r + '">' + i.replace(/@/g, "&#64;") + "</a>") : (t && (r += ' title="' + t + '"'),
                r += ">" + i + "</a>")
            }
            ,
            s.heading = function(e, i, o) {
                var n = e
                  , a = /\s*\<a\s*href\=\"(.*)\"\s*([^\>]*)\>(.*)\<\/a\>\s*/;
                if (a.test(e)) {
                    for (var s = [], l = 0, c = (e = e.split(/\<a\s*([^\>]+)\>([^\>]*)\<\/a\>/)).length; l < c; l++)
                        s.push(e[l].replace(/\s*href\=\"(.*)\"\s*/g, ""));
                    e = s.join(" ")
                }
                var h = (e = r(e)).toLowerCase().replace(/[^\w]+/g, "-")
                  , d = {
                    text: e,
                    level: i,
                    slug: h
                }
                  , u = /^[\u4e00-\u9fa5]+$/.test(e) ? escape(e).replace(/\%/g, "") : e.toLowerCase().replace(/[^\w]+/g, "-");
                t.push(d);
                var f = "<h" + i + ' id="h' + i + "-" + this.options.headerPrefix + u + '">';
                return f += '<a name="' + e + '" class="reference-link"></a>',
                f += '<span class="header-link octicon octicon-link"></span>',
                f += a ? this.atLink(this.emoji(n)) : this.atLink(this.emoji(e)),
                f += "</h" + i + ">"
            }
            ,
            s.pageBreak = function(e) {
                return m.test(e) && n.pageBreak && (e = '<hr style="page-break-after:always;" class="page-break editormd-page-break" />'),
                e
            }
            ,
            s.paragraph = function(e) {
                var t = /\$\$(.*)\$\$/g.test(e)
                  , i = /^\$\$(.*)\$\$$/.test(e)
                  , r = i ? ' class="' + o.classNames.tex + '"' : ""
                  , a = n.tocm ? /^(\[TOC\]|\[TOCM\])$/.test(e) : /^\[TOC\]$/.test(e)
                  , s = /^\[TOCM\]$/.test(e)
                  , l = '<div class="markdown-toc editormd-markdown-toc">' + (e = !i && t ? e.replace(/(\$\$([^\$]*)\$\$)+/g, function(e, t) {
                    return '<span class="' + o.classNames.tex + '">' + t.replace(/\$/g, "") + "</span>"
                }) : i ? e.replace(/\$/g, "") : e) + "</div>";
                return a ? s ? '<div class="editormd-toc-menu">' + l + "</div><br/>" : l : m.test(e) ? this.pageBreak(e) : "<p" + r + ">" + this.atLink(this.emoji(e)) + "</p>\n"
            }
            ,
            s.code = function(e, t, i) {
                return "seq" === t || "sequence" === t ? '<div class="sequence-diagram">' + e + "</div>" : "flow" === t ? '<div class="flowchart">' + e + "</div>" : "math" === t || "latex" === t || "katex" === t ? '<p class="' + o.classNames.tex + '">' + e + "</p>" : a.Renderer.prototype.code.apply(this, arguments)
            }
            ,
            s.tablecell = function(e, t) {
                var i = t.header ? "th" : "td";
                return (t.align ? "<" + i + ' style="text-align:' + t.align + '">' : "<" + i + ">") + this.atLink(this.emoji(e)) + "</" + i + ">\n"
            }
            ,
            s.listitem = function(e) {
                return n.taskList && /^\s*\[[x\s]\]\s*/.test(e) ? (e = e.replace(/^\s*\[\s\]\s*/, '<input type="checkbox" class="task-list-item-checkbox" /> ').replace(/^\s*\[x\]\s*/, '<input type="checkbox" class="task-list-item-checkbox" checked disabled /> '),
                '<li style="list-style: none;">' + this.atLink(this.emoji(e)) + "</li>") : "<li>" + this.atLink(this.emoji(e)) + "</li>"
            }
            ,
            s
        }
        ,
        o.markdownToCRenderer = function(e, t, i, o) {
            var r = ""
              , n = 0
              , a = this.classPrefix;
            o = o || 1;
            for (var s = 0, l = e.length; s < l; s++) {
                var c = e[s].text
                  , h = e[s].level;
                h < o || (r += h > n ? "" : h < n ? new Array(n - h + 2).join("</ul></li>") : "</ul></li>",
                r += '<li><a class="toc-level-' + h + '" href="#' + c + '" level="' + h + '">' + c + "</a><ul>",
                n = h)
            }
            var d = t.find(".markdown-toc");
            if (d.length < 1 && "false" === t.attr("previewContainer")) {
                var u = '<div class="markdown-toc ' + a + 'markdown-toc"></div>';
                u = i ? '<div class="' + a + 'toc-menu">' + u + "</div>" : u,
                t.html(u),
                d = t.find(".markdown-toc")
            }
            return i && d.wrap('<div class="' + a + 'toc-menu"></div><br/>'),
            d.html('<ul class="markdown-toc-list"></ul>').children(".markdown-toc-list").html(r.replace(/\r?\n?\<ul\>\<\/ul\>/g, "")),
            d
        }
        ,
        o.tocDropdownMenu = function(t, i) {
            i = i || "Table of Contents";
            var o = 400
              , r = t.find("." + this.classPrefix + "toc-menu");
            return r.each(function() {
                var t = e(this)
                  , r = t.children(".markdown-toc")
                  , n = '<i class="fa fa-angle-down"></i>'
                  , a = '<a href="javascript:;" class="toc-menu-btn">' + n + i + "</a>"
                  , s = r.children("ul")
                  , l = s.find("li");
                r.append(a),
                l.first().before("<li><h1>" + i + " " + n + "</h1></li>"),
                t.mouseover(function() {
                    s.show(),
                    l.each(function() {
                        var t = e(this)
                          , i = t.children("ul");
                        if ("" === i.html() && i.remove(),
                        i.length > 0 && "" !== i.html()) {
                            var r = t.children("a").first();
                            r.children(".fa").length < 1 && r.append(e(n).css({
                                float: "right",
                                paddingTop: "4px"
                            }))
                        }
                        t.mouseover(function() {
                            i.css("z-index", o).show(),
                            o += 1
                        }).mouseleave(function() {
                            i.hide()
                        })
                    })
                }).mouseleave(function() {
                    s.hide()
                })
            }),
            r
        }
        ,
        o.filterHTMLTags = function(t, i) {
            if ("string" != typeof t && (t = new String(t)),
            "string" != typeof i)
                return t;
            for (var o = i.split("|"), r = o[0].split(","), n = o[1], a = 0, s = r.length; a < s; a++) {
                var l = r[a];
                t = t.replace(new RegExp("<s*" + l + "s*([^>]*)>([^>]*)<s*/" + l + "s*>","igm"), "")
            }
            if (void 0 !== n) {
                var c = /\<(\w+)\s*([^\>]*)\>([^\>]*)\<\/(\w+)\>/gi;
                t = "*" === n ? t.replace(c, function(e, t, i, o, r) {
                    return "<" + t + ">" + o + "</" + r + ">"
                }) : "on*" === n ? t.replace(c, function(t, i, o, r, n) {
                    var a = e("<" + i + ">" + r + "</" + n + ">")
                      , s = e(t)[0].attributes
                      , l = {};
                    e.each(s, function(e, t) {
                        '"' !== t.nodeName && (l[t.nodeName] = t.nodeValue)
                    }),
                    e.each(l, function(e) {
                        0 === e.indexOf("on") && delete l[e]
                    }),
                    a.attr(l);
                    var c = void 0 !== a[1] ? e(a[1]).text() : "";
                    return a[0].outerHTML + c
                }) : t.replace(c, function(t, i, o, r) {
                    var a = n.split(",")
                      , s = e(t);
                    return s.html(r),
                    e.each(a, function(e) {
                        s.attr(a[e], null)
                    }),
                    s[0].outerHTML
                })
            }
            return t
        }
        ,
        o.markdownToHTML = function(t, i) {
            o.$marked = marked;
            var r = e("#" + t)
              , n = r.settings = e.extend(!0, {
                gfm: !0,
                toc: !0,
                tocm: !1,
                tocStartLevel: 1,
                tocTitle: "目录",
                tocDropdown: !1,
                tocContainer: "",
                markdown: "",
                markdownSourceCode: !1,
                htmlDecode: !1,
                autoLoadKaTeX: !0,
                pageBreak: !0,
                atLink: !0,
                emailLink: !0,
                tex: !1,
                taskList: !1,
                emoji: !1,
                flowChart: !1,
                sequenceDiagram: !1,
                previewCodeHighlight: !0
            }, i || {})
              , a = r.find("textarea");
            a.length < 1 && (r.append("<textarea></textarea>"),
            a = r.find("textarea"));
            var s = "" === n.markdown ? a.val() : n.markdown
              , l = []
              , c = {
                toc: n.toc,
                tocm: n.tocm,
                tocStartLevel: n.tocStartLevel,
                taskList: n.taskList,
                emoji: n.emoji,
                tex: n.tex,
                pageBreak: n.pageBreak,
                atLink: n.atLink,
                emailLink: n.emailLink,
                flowChart: n.flowChart,
                sequenceDiagram: n.sequenceDiagram,
                previewCodeHighlight: n.previewCodeHighlight
            }
              , h = {
                renderer: o.markedRenderer(l, c),
                gfm: n.gfm,
                tables: !0,
                breaks: !0,
                pedantic: !1,
                sanitize: !n.htmlDecode,
                smartLists: !0,
                smartypants: !0
            };
            s = new String(s);
            var d = marked(s, h);
            d = o.filterHTMLTags(d, n.htmlDecode),
            n.markdownSourceCode ? a.text(s) : a.remove(),
            r.addClass("markdown-body " + this.classPrefix + "html-preview").append(d);
            var u = "" !== n.tocContainer ? e(n.tocContainer) : r;
            if ("" !== n.tocContainer && u.attr("previewContainer", !1),
            n.toc && (r.tocContainer = this.markdownToCRenderer(l, u, n.tocDropdown, n.tocStartLevel),
            (n.tocDropdown || r.find("." + this.classPrefix + "toc-menu").length > 0) && this.tocDropdownMenu(r, n.tocTitle),
            "" !== n.tocContainer && r.find(".editormd-toc-menu, .editormd-markdown-toc").remove()),
            n.previewCodeHighlight && (r.find("pre").addClass("prettyprint linenums"),
            prettyPrint()),
            o.isIE8 || (n.flowChart && r.find(".flowchart").flowChart(),
            n.sequenceDiagram && r.find(".sequence-diagram").sequenceDiagram({
                theme: "simple"
            })),
            n.tex) {
                var f = function() {
                    r.find("." + o.classNames.tex).each(function() {
                        var t = e(this);
                        katex.render(t.html().replace(/&lt;/g, "<").replace(/&gt;/g, ">"), t[0]),
                        t.find(".katex").css("font-size", "1.6em")
                    })
                };
                !n.autoLoadKaTeX || o.$katex || o.kaTeXLoaded ? f() : this.loadKaTeX(function() {
                    o.$katex = katex,
                    o.kaTeXLoaded = !0,
                    f()
                })
            }
            return r.getMarkdown = function() {
                return a.val()
            }
            ,
            r
        }
        ,
        o.themes = ["default", "dark"],
        o.previewThemes = ["default", "dark"],
        o.editorThemes = ["default", "3024-day", "3024-night", "ambiance", "ambiance-mobile", "base16-dark", "base16-light", "blackboard", "cobalt", "eclipse", "elegant", "erlang-dark", "lesser-dark", "mbo", "mdn-like", "midnight", "monokai", "neat", "neo", "night", "paraiso-dark", "paraiso-light", "pastel-on-dark", "rubyblue", "solarized", "the-matrix", "tomorrow-night-eighties", "twilight", "vibrant-ink", "xq-dark", "xq-light"],
        o.loadPlugins = {},
        o.loadFiles = {
            js: [],
            css: [],
            plugin: []
        },
        o.loadPlugin = function(e, t, i) {
            t = t || function() {}
            ,
            this.loadScript(e, function() {
                o.loadFiles.plugin.push(e),
                t()
            }, i)
        }
        ,
        o.loadCSS = function(e, t, i) {
            i = i || "head",
            t = t || function() {}
            ;
            var r = document.createElement("link");
            r.type = "text/css",
            r.rel = "stylesheet",
            r.onload = r.onreadystatechange = function() {
                o.loadFiles.css.push(e),
                t()
            }
            ,
            r.href = e + ".css",
            "head" === i ? document.getElementsByTagName("head")[0].appendChild(r) : document.body.appendChild(r)
        }
        ,
        o.isIE = "Microsoft Internet Explorer" == navigator.appName,
        o.isIE8 = o.isIE && "8." == navigator.appVersion.match(/8./i),
        o.loadScript = function(e, t, i) {
            i = i || "head",
            t = t || function() {}
            ;
            var r = null;
            (r = document.createElement("script")).id = e.replace(/[\./]+/g, "-"),
            r.type = "text/javascript",
            r.src = e + ".js",
            o.isIE8 ? r.onreadystatechange = function() {
                r.readyState && ("loaded" !== r.readyState && "complete" !== r.readyState || (r.onreadystatechange = null,
                o.loadFiles.js.push(e),
                t()))
            }
            : r.onload = function() {
                o.loadFiles.js.push(e),
                t()
            }
            ,
            "head" === i ? document.getElementsByTagName("head")[0].appendChild(r) : document.body.appendChild(r)
        }
        ,
        o.katexURL = {
            css: "//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.3.0/katex.min",
            js: "//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.3.0/katex.min"
        },
        o.kaTeXLoaded = !1,
        o.loadKaTeX = function(e) {
            o.loadCSS(o.katexURL.css, function() {
                o.loadScript(o.katexURL.js, e || function() {}
                )
            })
        }
        ,
        o.lockScreen = function(t) {
            e("html,body").css("overflow", t ? "hidden" : "")
        }
        ,
        o.createDialog = function(t) {
            t = e.extend(!0, {
                name: "",
                width: 420,
                height: 240,
                title: "",
                drag: !0,
                closed: !0,
                content: "",
                mask: !0,
                maskStyle: {
                    backgroundColor: "#fff",
                    opacity: .1
                },
                lockScreen: !0,
                footer: !0,
                buttons: !1
            }, t);
            var i = this
              , r = this.editor
              , n = o.classPrefix
              , a = (new Date).getTime()
              , s = "" === t.name ? n + "dialog-" + a : t.name
              , l = o.mouseOrTouch
              , c = '<div class="' + n + "dialog " + s + '">';
            "" !== t.title && (c += '<div class="' + n + 'dialog-header"' + (t.drag ? ' style="cursor: move;"' : "") + ">",
            c += '<strong class="' + n + 'dialog-title">' + t.title + "</strong>",
            c += "</div>"),
            t.closed && (c += '<a href="javascript:;" class="fa fa-close ' + n + 'dialog-close"></a>'),
            c += '<div class="' + n + 'dialog-container">' + t.content,
            (t.footer || "string" == typeof t.footer) && (c += '<div class="' + n + 'dialog-footer">' + ("boolean" == typeof t.footer ? "" : t.footer) + "</div>"),
            c += "</div>",
            c += '<div class="' + n + "dialog-mask " + n + 'dialog-mask-bg"></div>',
            c += '<div class="' + n + "dialog-mask " + n + 'dialog-mask-con"></div>',
            c += "</div>",
            r.append(c);
            var h = r.find("." + s);
            h.lockScreen = function(o) {
                return t.lockScreen && (e("html,body").css("overflow", o ? "hidden" : ""),
                i.resize()),
                h
            }
            ,
            h.showMask = function() {
                return t.mask && r.find("." + n + "mask").css(t.maskStyle).css("z-index", o.dialogZindex - 1).show(),
                h
            }
            ,
            h.hideMask = function() {
                return t.mask && r.find("." + n + "mask").hide(),
                h
            }
            ,
            h.loading = function(e) {
                return h.find("." + n + "dialog-mask")[e ? "show" : "hide"](),
                h
            }
            ,
            h.lockScreen(!0).showMask(),
            h.show().css({
                zIndex: o.dialogZindex,
                border: o.isIE8 ? "1px solid #ddd" : "",
                width: "number" == typeof t.width ? t.width + "px" : t.width,
                height: "number" == typeof t.height ? t.height + "px" : t.height
            });
            var d = function() {
                h.css({
                    top: (e(window).height() - h.height()) / 2 + "px",
                    left: (e(window).width() - h.width()) / 2 + "px"
                })
            };
            if (d(),
            e(window).resize(d),
            h.children("." + n + "dialog-close").bind(l("click", "touchend"), function() {
                h.hide().lockScreen(!1).hideMask()
            }),
            "object" == typeof t.buttons) {
                var u = h.footer = h.find("." + n + "dialog-footer");
                for (var f in t.buttons) {
                    var g = t.buttons[f]
                      , p = n + f + "-btn";
                    u.append('<button class="' + n + "btn " + p + '">' + g[0] + "</button>"),
                    g[1] = e.proxy(g[1], h),
                    u.children("." + p).bind(l("click", "touchend"), g[1])
                }
            }
            if ("" !== t.title && t.drag) {
                var m, w, v = h.children("." + n + "dialog-header");
                t.mask || v.bind(l("click", "touchend"), function() {
                    o.dialogZindex += 2,
                    h.css("z-index", o.dialogZindex)
                }),
                v.mousedown(function(e) {
                    e = e || window.event,
                    m = e.clientX - parseInt(h[0].style.left),
                    w = e.clientY - parseInt(h[0].style.top),
                    document.onmousemove = x
                });
                var k = function(e) {
                    e.removeClass(n + "user-unselect").off("selectstart")
                }
                  , b = function(e) {
                    e.addClass(n + "user-unselect").on("selectstart", function(e) {
                        return !1
                    })
                }
                  , x = function(t) {
                    t = t || window.event;
                    var i, o, r = parseInt(h[0].style.left), n = parseInt(h[0].style.top);
                    r >= 0 ? r + h.width() <= e(window).width() ? i = t.clientX - m : (i = e(window).width() - h.width(),
                    document.onmousemove = null) : (i = 0,
                    document.onmousemove = null),
                    n >= 0 ? o = t.clientY - w : (o = 0,
                    document.onmousemove = null),
                    document.onselectstart = function() {
                        return !1
                    }
                    ,
                    b(e("body")),
                    b(h),
                    h[0].style.left = i + "px",
                    h[0].style.top = o + "px"
                };
                document.onmouseup = function() {
                    k(e("body")),
                    k(h),
                    document.onselectstart = null,
                    document.onmousemove = null
                }
                ,
                v.touchDraggable = function() {
                    var t = null;
                    this.bind("touchstart", function(i) {
                        var o = i.originalEvent
                          , r = e(this).parent().position();
                        t = {
                            x: o.changedTouches[0].pageX - r.left,
                            y: o.changedTouches[0].pageY - r.top
                        }
                    }).bind("touchmove", function(i) {
                        i.preventDefault();
                        var o = i.originalEvent;
                        e(this).parent().css({
                            top: o.changedTouches[0].pageY - t.y,
                            left: o.changedTouches[0].pageX - t.x
                        })
                    })
                }
                ,
                v.touchDraggable()
            }
            return o.dialogZindex += 2,
            h
        }
        ,
        o.mouseOrTouch = function(e, t) {
            t = t || "touchend";
            var i = e = e || "click";
            try {
                document.createEvent("TouchEvent"),
                i = t
            } catch (e) {}
            return i
        }
        ,
        o.dateFormat = function(e) {
            e = e || "";
            var t = function(e) {
                return e < 10 ? "0" + e : e
            }
              , i = new Date
              , o = i.getFullYear()
              , r = o.toString().slice(2, 4)
              , n = t(i.getMonth() + 1)
              , a = t(i.getDate())
              , s = i.getDay()
              , l = t(i.getHours())
              , c = t(i.getMinutes())
              , h = t(i.getSeconds())
              , d = t(i.getMilliseconds())
              , u = ""
              , f = r + "-" + n + "-" + a
              , g = o + "-" + n + "-" + a
              , p = l + ":" + c + ":" + h;
            switch (e) {
            case "UNIX Time":
                u = i.getTime();
                break;
            case "UTC":
                u = i.toUTCString();
                break;
            case "yy":
                u = r;
                break;
            case "year":
            case "yyyy":
                u = o;
                break;
            case "month":
            case "mm":
                u = n;
                break;
            case "cn-week-day":
            case "cn-wd":
                u = "星期" + ["日", "一", "二", "三", "四", "五", "六"][s];
                break;
            case "week-day":
            case "wd":
                u = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"][s];
                break;
            case "day":
            case "dd":
                u = a;
                break;
            case "hour":
            case "hh":
                u = l;
                break;
            case "min":
            case "ii":
                u = c;
                break;
            case "second":
            case "ss":
                u = h;
                break;
            case "ms":
                u = d;
                break;
            case "yy-mm-dd":
                u = f;
                break;
            case "yyyy-mm-dd":
                u = g;
                break;
            case "yyyy-mm-dd h:i:s ms":
            case "full + ms":
                u = g + " " + p + " " + d;
                break;
            case "full":
            case "yyyy-mm-dd h:i:s":
            default:
                u = g + " " + p
            }
            return u
        }
        ,
        o
    }
});
