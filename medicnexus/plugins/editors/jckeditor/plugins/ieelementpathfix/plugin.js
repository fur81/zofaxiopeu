/*------------------------------------------------------------------------
# Copyright (C) 2005-2012 WebxSolution Ltd. All Rights Reserved.
# @license - GPLv2.0
# Author: WebxSolution Ltd
# Websites:  http://www.webxsolution.com
# Terms of Use: An extension that is derived from the JoomlaCK editor will only be allowed under the following conditions: http://joomlackeditor.com/terms-of-use
# ------------------------------------------------------------------------*/ 
CKEDITOR.plugins.add("ieelementpathfix",{init:function(a){},afterInit:function(a){var b=a.dataProcessor,c=b&&b.htmlFilter;var d=b&&b.dataFilter;if(c){c.addRules({elements:{img:function(b){var c=a.config.client?a.config.baseHref+"administrator/":a.config.baseHref;c=c.replace(/\s+/g,"%20").replace(/~/,"%7E");if(CKEDITOR.env.ie){if(b.attributes.src){if(b.attributes.src.indexOf(c)!=-1&&b.attributes.src.indexOf("//")!=-1){var d=b.attributes.src.replace(c,"");b.attributes.src=d}}if(b.attributes._cke_saved_src){if(b.attributes._cke_saved_src.indexOf(c)!=-1&&b.attributes._cke_saved_src.indexOf("//")!=-1){var d=b.attributes._cke_saved_src.replace(c,"");b.attributes._cke_saved_src=d}}}return b},a:function(b){var c=a.config.client?a.config.baseHref+"administrator/":a.config.baseHref;c=c.replace(/\s+/g,"%20").replace(/~/,"%7E");if(CKEDITOR.env.ie){if(b.attributes.href){b.attributes.href.replace("%7","~");if(b.attributes.href.indexOf(c)!=-1&&b.attributes.href.indexOf("//")!=-1){var d=b.attributes.href.replace(c,"");b.attributes.href=d}}if(b.attributes._cke_saved_href){if(b.attributes._cke_saved_href.indexOf(c)!=-1&&b.attributes._cke_saved_href.indexOf("//")!=-1){var d=b.attributes._cke_saved_href.replace(c,"");b.attributes._cke_saved_href=d}}}return b}}})}if(d){d.addRules({elements:{img:function(b){var c=a.config.baseHref+"administrator/";c=c.replace(/\s+/g,"%20").replace(/~/,"%7E");if(CKEDITOR.env.ie){if(b.attributes.src){if(b.attributes.src.indexOf(c)!=-1&&b.attributes.src.indexOf("//")!=-1){var d=b.attributes.src.replace(c,"");b.attributes.src=d}}if(b.attributes._cke_saved_src){var c=a.config.baseHref+"administrator/";c=c.replace(/\s+/g,"%20").replace(/~/,"%7E");if(b.attributes._cke_saved_src.indexOf(c)!=-1&&b.attributes._cke_saved_src.indexOf("//")!=-1){var d=b.attributes._cke_saved_src.replace(c,"");b.attributes._cke_saved_src=d}}}return b},a:function(b){var c=a.config.baseHref+"administrator/";c=c.replace(/\s+/g,"%20").replace(/~/,"%7E");if(CKEDITOR.env.ie8||CKEDITOR.env.ie7Compat){if(b.attributes.href){if(b.attributes.href.indexOf(c)!=-1&&b.attributes.href.indexOf("//")!=-1){var d=b.attributes.href.replace(c,"");b.attributes.href=d}}if(b.attributes._cke_saved_href){if(b.attributes._cke_saved_href.indexOf(c)!=-1&&b.attributes._cke_saved_href.indexOf("//")!=-1){var d=b.attributes._cke_saved_href.replace(c,"");b.attributes._cke_saved_href=d}}}return b}}})}}})