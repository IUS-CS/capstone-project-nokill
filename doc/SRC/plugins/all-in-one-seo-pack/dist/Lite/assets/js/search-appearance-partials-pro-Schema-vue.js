(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["search-appearance-partials-pro-Schema-vue"],{"2d4c":function(t,e,i){"use strict";i("38d8")},"38d8":function(t,e,i){},"781e":function(t,e,i){"use strict";i.r(e);var s=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"aioseo-sa-ct-schema"},[i("core-settings-row",{attrs:{name:t.strings.schemaType,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[i("base-select",{staticClass:"schema-type",attrs:{size:"medium",options:t.getSelectOptions("schemaTypes"),value:t.getCurrentOption("schemaTypes",t.options.schemaType)},on:{input:function(e){return t.options.schemaType=e.value}}})]},proxy:!0}])}),"WebPage"===t.options.schemaType?i("core-settings-row",{attrs:{name:t.strings.webPageType,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[i("base-select",{staticClass:"webpage-type",attrs:{size:"medium",options:t.getSelectOptions("webPageTypes"),value:t.getCurrentOption("webPageTypes",t.options.webPageType)},on:{input:function(e){return t.options.webPageType=e.value}}})]},proxy:!0}],null,!1,3344221424)}):t._e(),"Article"===t.options.schemaType?i("core-settings-row",{attrs:{name:t.strings.articleType,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[i("base-radio-toggle",{attrs:{name:t.object.name+"articleType",options:[{label:t.strings.article,value:"Article"},{label:t.strings.blogPost,value:"BlogPosting"},{label:t.strings.newsArticle,value:"NewsArticle"}]},model:{value:t.options.articleType,callback:function(e){t.$set(t.options,"articleType",e)},expression:"options.articleType"}})]},proxy:!0}],null,!1,3288395150)}):t._e()],1)},a=[],l=(i("b0c0"),i("7db0"),{props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0}},data:function(){return{schemaTypes:{post:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"Article",label:this.$t.__("Article",this.$tdPro)},{value:"Course",label:this.$t.__("Course",this.$td)},{value:"Product",label:this.$t.__("Product",this.$tdPro)},{value:"Recipe",label:this.$t.__("Recipe",this.$td)},{value:"SoftwareApplication",label:this.$t.__("Software Application",this.$tdPro)},{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)}],page:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"Course",label:this.$t.__("Course",this.$td)},{value:"Product",label:this.$t.__("Product",this.$tdPro)},{value:"Recipe",label:this.$t.__("Recipe",this.$td)},{value:"SoftwareApplication",label:this.$t.__("Software Application",this.$tdPro)},{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)}],attachment:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"ItemPage",label:this.$t.__("Item Page",this.$tdPro)}],cpt:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"Article",label:this.$t.__("Article",this.$tdPro)},{value:"Course",label:this.$t.__("Course",this.$td)},{value:"Product",label:this.$t.__("Product",this.$tdPro)},{value:"Recipe",label:this.$t.__("Recipe",this.$td)},{value:"SoftwareApplication",label:this.$t.__("Software Application",this.$tdPro)},{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)}]},webPageTypes:{cpt:[{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)},{value:"CollectionPage",label:this.$t.__("Collection Page",this.$tdPro)},{value:"ProfilePage",label:this.$t.__("Profile Page",this.$tdPro)},{value:"ItemPage",label:this.$t.__("Item Page",this.$tdPro)},{value:"FAQPage",label:this.$t.__("FAQ Page",this.$tdPro)},{value:"RealEstateListing",label:this.$t.__("Real Estate Listing",this.$tdPro)}]},strings:{schemaType:this.$t.__("Schema Type",this.$tdPro),webPageType:this.$t.__("Web Page Type",this.$td),articleType:this.$t.__("Article Type",this.$tdPro),article:this.$t.__("Article",this.$tdPro),blogPost:this.$t.__("Blog Post",this.$tdPro),newsArticle:this.$t.__("News Article",this.$tdPro)}}},methods:{getSelectOptions:function(t){return"undefined"!==typeof this[t][this.object.name]?this[t][this.object.name]:this[t].cpt},getCurrentOption:function(t,e){return"undefined"!==typeof this[t][this.object.name]?this[t][this.object.name].find((function(t){return t.value===e})):this[t].cpt.find((function(t){return t.value===e}))}}}),o=l,n=(i("2d4c"),i("2877")),r=Object(n["a"])(o,s,a,!1,null,null,null);e["default"]=r.exports}}]);