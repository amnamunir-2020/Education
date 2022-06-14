(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";

var timeout = undefined;
var icons = wpcfto_icons_set;
Vue.component('consulting_icon_picker', {
  props: ['fields', 'field_label', 'field_name', 'field_id', 'field_value', 'field_data'],
  data: function data() {
    return {
      value: '',
      focusOn: false,
      icons: icons,
      hoverPanel: false,
      search: "",
      beforeSelect: "",
      selected: "",
      inited: false
    };
  },
  template: "\n        <div class=\"wpcfto_generic_field wpcfto_generic_field_iconpicker\">\n\n            <wpcfto_fields_aside_before :fields=\"fields\" :field_label=\"field_label\"></wpcfto_fields_aside_before>\n            \n            <div class=\"wpcfto-field-content\">\n                <div class=\"wpcfto_generic_field__inner\">\n    \n                    <div class=\"wpcfto_generic_field\" style=\"width: 100%;\">\n                        <label style=\"margin-bottom: 0\"></label>\n                        <input ref=\"picker\"\n                        v-model=\"search\"\n                        @blur=\"blur\"\n                        @focus=\"focus\"\n                        type=\"text\"\n                        class=\"form-control\"\n                        placeholder=\"Search an icon\">\n                    </div>\n          \n                </div>\n    \n                <transition name=\"icon-preview-fade\">\n                    <div v-if=\"focusOn\" class=\"preview-container\">\n                        <div @click=\"select(undefined)\" @mouseover=\"hoverPanel = true\" @mouseout=\"hoverPanel = false\" :class=\"['previewer', 'rounded', {'custom-shadow-sm': !hoverPanel}, {'custom-shadow': hoverPanel} ]\">\n                            <div v-for=\"(i, index) in iconsFiltered\" :key=\"index\" class=\"icon-preview\">\n                                <div @click.prevent.stop=\"select(i)\" :class=\"['icon-wrapper','rounded','shadow-sm', {selected: i.title == selected}]\" >\n                                    <i :class=\"i.title\" />\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </transition>\n            \n                 <div class=\"icon-preview-wrap\">\n                    <label style=\"margin-bottom: 0\"></label>\n                    <div class=\"icon-preview-inner\" style=\"width: 40px; height: 40px;\">\n                        <i class=\"wpcfto_generic_field__iconpicker__icon\"\n                        v-bind:class=\"value\"\n                        style=\"font-size: 24px;\"\n                        v-if=\"value && value !== ''\"></i>  \n                        <span v-else>--</span>  \n                    </div>        \n                 </div>\n             </div>\n\n        </div>\n  ",
  mounted: function mounted() {
    this.value = this.field_value;
    this.selected = this.value;
    this.inited = true;
  },
  methods: {
    blur: function blur() {
      var _this = this;

      timeout = setTimeout(function () {
        _this.focusOn = false;
        _this.value = '';
      }, 100);
    },
    focus: function focus() {
      this.focusOn = true;
    },
    select: function select(icon) {
      clearTimeout(timeout);

      if (icon) {
        if (this.search != this.selected) this.beforeSelect = this.search;
        this.selected = icon.title;
        this.search = icon.title;
      }

      this.focusOn = false;
      this.value = this.selected;
    }
  },
  computed: {
    iconsFiltered: function iconsFiltered() {
      var search = this.search == this.selected ? this.beforeSelect : this.search;
      return this.icons.filter(function (i) {
        return i.title.indexOf(search) !== -1 || i.searchTerms.some(function (t) {
          return t.indexOf(search) !== -1;
        });
      });
    }
  },
  watch: {
    value: {
      deep: true,
      handler: function handler(value) {
        this.$emit('wpcfto-get-value', value);
      }
    }
  }
});
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImZha2VfZjE2YzdmZTYuanMiXSwibmFtZXMiOlsidGltZW91dCIsInVuZGVmaW5lZCIsImljb25zIiwid3BjZnRvX2ljb25zX3NldCIsIlZ1ZSIsImNvbXBvbmVudCIsInByb3BzIiwiZGF0YSIsInZhbHVlIiwiZm9jdXNPbiIsImhvdmVyUGFuZWwiLCJzZWFyY2giLCJiZWZvcmVTZWxlY3QiLCJzZWxlY3RlZCIsImluaXRlZCIsInRlbXBsYXRlIiwibW91bnRlZCIsImZpZWxkX3ZhbHVlIiwibWV0aG9kcyIsImJsdXIiLCJfdGhpcyIsInNldFRpbWVvdXQiLCJmb2N1cyIsInNlbGVjdCIsImljb24iLCJjbGVhclRpbWVvdXQiLCJ0aXRsZSIsImNvbXB1dGVkIiwiaWNvbnNGaWx0ZXJlZCIsImZpbHRlciIsImkiLCJpbmRleE9mIiwic2VhcmNoVGVybXMiLCJzb21lIiwidCIsIndhdGNoIiwiZGVlcCIsImhhbmRsZXIiLCIkZW1pdCJdLCJtYXBwaW5ncyI6IkFBQUE7O0FBRUEsSUFBSUEsT0FBTyxHQUFHQyxTQUFkO0FBQ0EsSUFBSUMsS0FBSyxHQUFHQyxnQkFBWjtBQUNBQyxHQUFHLENBQUNDLFNBQUosQ0FBYyx3QkFBZCxFQUF3QztBQUN0Q0MsRUFBQUEsS0FBSyxFQUFFLENBQUMsUUFBRCxFQUFXLGFBQVgsRUFBMEIsWUFBMUIsRUFBd0MsVUFBeEMsRUFBb0QsYUFBcEQsRUFBbUUsWUFBbkUsQ0FEK0I7QUFFdENDLEVBQUFBLElBQUksRUFBRSxTQUFTQSxJQUFULEdBQWdCO0FBQ3BCLFdBQU87QUFDTEMsTUFBQUEsS0FBSyxFQUFFLEVBREY7QUFFTEMsTUFBQUEsT0FBTyxFQUFFLEtBRko7QUFHTFAsTUFBQUEsS0FBSyxFQUFFQSxLQUhGO0FBSUxRLE1BQUFBLFVBQVUsRUFBRSxLQUpQO0FBS0xDLE1BQUFBLE1BQU0sRUFBRSxFQUxIO0FBTUxDLE1BQUFBLFlBQVksRUFBRSxFQU5UO0FBT0xDLE1BQUFBLFFBQVEsRUFBRSxFQVBMO0FBUUxDLE1BQUFBLE1BQU0sRUFBRTtBQVJILEtBQVA7QUFVRCxHQWJxQztBQWN0Q0MsRUFBQUEsUUFBUSxFQUFFLG95RUFkNEI7QUFldENDLEVBQUFBLE9BQU8sRUFBRSxTQUFTQSxPQUFULEdBQW1CO0FBQzFCLFNBQUtSLEtBQUwsR0FBYSxLQUFLUyxXQUFsQjtBQUNBLFNBQUtKLFFBQUwsR0FBZ0IsS0FBS0wsS0FBckI7QUFDQSxTQUFLTSxNQUFMLEdBQWMsSUFBZDtBQUNELEdBbkJxQztBQW9CdENJLEVBQUFBLE9BQU8sRUFBRTtBQUNQQyxJQUFBQSxJQUFJLEVBQUUsU0FBU0EsSUFBVCxHQUFnQjtBQUNwQixVQUFJQyxLQUFLLEdBQUcsSUFBWjs7QUFFQXBCLE1BQUFBLE9BQU8sR0FBR3FCLFVBQVUsQ0FBQyxZQUFZO0FBQy9CRCxRQUFBQSxLQUFLLENBQUNYLE9BQU4sR0FBZ0IsS0FBaEI7QUFDQVcsUUFBQUEsS0FBSyxDQUFDWixLQUFOLEdBQWMsRUFBZDtBQUNELE9BSG1CLEVBR2pCLEdBSGlCLENBQXBCO0FBSUQsS0FSTTtBQVNQYyxJQUFBQSxLQUFLLEVBQUUsU0FBU0EsS0FBVCxHQUFpQjtBQUN0QixXQUFLYixPQUFMLEdBQWUsSUFBZjtBQUNELEtBWE07QUFZUGMsSUFBQUEsTUFBTSxFQUFFLFNBQVNBLE1BQVQsQ0FBZ0JDLElBQWhCLEVBQXNCO0FBQzVCQyxNQUFBQSxZQUFZLENBQUN6QixPQUFELENBQVo7O0FBRUEsVUFBSXdCLElBQUosRUFBVTtBQUNSLFlBQUksS0FBS2IsTUFBTCxJQUFlLEtBQUtFLFFBQXhCLEVBQWtDLEtBQUtELFlBQUwsR0FBb0IsS0FBS0QsTUFBekI7QUFDbEMsYUFBS0UsUUFBTCxHQUFnQlcsSUFBSSxDQUFDRSxLQUFyQjtBQUNBLGFBQUtmLE1BQUwsR0FBY2EsSUFBSSxDQUFDRSxLQUFuQjtBQUNEOztBQUVELFdBQUtqQixPQUFMLEdBQWUsS0FBZjtBQUNBLFdBQUtELEtBQUwsR0FBYSxLQUFLSyxRQUFsQjtBQUNEO0FBdkJNLEdBcEI2QjtBQTZDdENjLEVBQUFBLFFBQVEsRUFBRTtBQUNSQyxJQUFBQSxhQUFhLEVBQUUsU0FBU0EsYUFBVCxHQUF5QjtBQUN0QyxVQUFJakIsTUFBTSxHQUFHLEtBQUtBLE1BQUwsSUFBZSxLQUFLRSxRQUFwQixHQUErQixLQUFLRCxZQUFwQyxHQUFtRCxLQUFLRCxNQUFyRTtBQUNBLGFBQU8sS0FBS1QsS0FBTCxDQUFXMkIsTUFBWCxDQUFrQixVQUFVQyxDQUFWLEVBQWE7QUFDcEMsZUFBT0EsQ0FBQyxDQUFDSixLQUFGLENBQVFLLE9BQVIsQ0FBZ0JwQixNQUFoQixNQUE0QixDQUFDLENBQTdCLElBQWtDbUIsQ0FBQyxDQUFDRSxXQUFGLENBQWNDLElBQWQsQ0FBbUIsVUFBVUMsQ0FBVixFQUFhO0FBQ3ZFLGlCQUFPQSxDQUFDLENBQUNILE9BQUYsQ0FBVXBCLE1BQVYsTUFBc0IsQ0FBQyxDQUE5QjtBQUNELFNBRndDLENBQXpDO0FBR0QsT0FKTSxDQUFQO0FBS0Q7QUFSTyxHQTdDNEI7QUF1RHRDd0IsRUFBQUEsS0FBSyxFQUFFO0FBQ0wzQixJQUFBQSxLQUFLLEVBQUU7QUFDTDRCLE1BQUFBLElBQUksRUFBRSxJQUREO0FBRUxDLE1BQUFBLE9BQU8sRUFBRSxTQUFTQSxPQUFULENBQWlCN0IsS0FBakIsRUFBd0I7QUFDL0IsYUFBSzhCLEtBQUwsQ0FBVyxrQkFBWCxFQUErQjlCLEtBQS9CO0FBQ0Q7QUFKSTtBQURGO0FBdkQrQixDQUF4QyIsInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xuXG52YXIgdGltZW91dCA9IHVuZGVmaW5lZDtcbnZhciBpY29ucyA9IHdwY2Z0b19pY29uc19zZXQ7XG5WdWUuY29tcG9uZW50KCdjb25zdWx0aW5nX2ljb25fcGlja2VyJywge1xuICBwcm9wczogWydmaWVsZHMnLCAnZmllbGRfbGFiZWwnLCAnZmllbGRfbmFtZScsICdmaWVsZF9pZCcsICdmaWVsZF92YWx1ZScsICdmaWVsZF9kYXRhJ10sXG4gIGRhdGE6IGZ1bmN0aW9uIGRhdGEoKSB7XG4gICAgcmV0dXJuIHtcbiAgICAgIHZhbHVlOiAnJyxcbiAgICAgIGZvY3VzT246IGZhbHNlLFxuICAgICAgaWNvbnM6IGljb25zLFxuICAgICAgaG92ZXJQYW5lbDogZmFsc2UsXG4gICAgICBzZWFyY2g6IFwiXCIsXG4gICAgICBiZWZvcmVTZWxlY3Q6IFwiXCIsXG4gICAgICBzZWxlY3RlZDogXCJcIixcbiAgICAgIGluaXRlZDogZmFsc2VcbiAgICB9O1xuICB9LFxuICB0ZW1wbGF0ZTogXCJcXG4gICAgICAgIDxkaXYgY2xhc3M9XFxcIndwY2Z0b19nZW5lcmljX2ZpZWxkIHdwY2Z0b19nZW5lcmljX2ZpZWxkX2ljb25waWNrZXJcXFwiPlxcblxcbiAgICAgICAgICAgIDx3cGNmdG9fZmllbGRzX2FzaWRlX2JlZm9yZSA6ZmllbGRzPVxcXCJmaWVsZHNcXFwiIDpmaWVsZF9sYWJlbD1cXFwiZmllbGRfbGFiZWxcXFwiPjwvd3BjZnRvX2ZpZWxkc19hc2lkZV9iZWZvcmU+XFxuICAgICAgICAgICAgXFxuICAgICAgICAgICAgPGRpdiBjbGFzcz1cXFwid3BjZnRvLWZpZWxkLWNvbnRlbnRcXFwiPlxcbiAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVxcXCJ3cGNmdG9fZ2VuZXJpY19maWVsZF9faW5uZXJcXFwiPlxcbiAgICBcXG4gICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XFxcIndwY2Z0b19nZW5lcmljX2ZpZWxkXFxcIiBzdHlsZT1cXFwid2lkdGg6IDEwMCU7XFxcIj5cXG4gICAgICAgICAgICAgICAgICAgICAgICA8bGFiZWwgc3R5bGU9XFxcIm1hcmdpbi1ib3R0b206IDBcXFwiPjwvbGFiZWw+XFxuICAgICAgICAgICAgICAgICAgICAgICAgPGlucHV0IHJlZj1cXFwicGlja2VyXFxcIlxcbiAgICAgICAgICAgICAgICAgICAgICAgIHYtbW9kZWw9XFxcInNlYXJjaFxcXCJcXG4gICAgICAgICAgICAgICAgICAgICAgICBAYmx1cj1cXFwiYmx1clxcXCJcXG4gICAgICAgICAgICAgICAgICAgICAgICBAZm9jdXM9XFxcImZvY3VzXFxcIlxcbiAgICAgICAgICAgICAgICAgICAgICAgIHR5cGU9XFxcInRleHRcXFwiXFxuICAgICAgICAgICAgICAgICAgICAgICAgY2xhc3M9XFxcImZvcm0tY29udHJvbFxcXCJcXG4gICAgICAgICAgICAgICAgICAgICAgICBwbGFjZWhvbGRlcj1cXFwiU2VhcmNoIGFuIGljb25cXFwiPlxcbiAgICAgICAgICAgICAgICAgICAgPC9kaXY+XFxuICAgICAgICAgIFxcbiAgICAgICAgICAgICAgICA8L2Rpdj5cXG4gICAgXFxuICAgICAgICAgICAgICAgIDx0cmFuc2l0aW9uIG5hbWU9XFxcImljb24tcHJldmlldy1mYWRlXFxcIj5cXG4gICAgICAgICAgICAgICAgICAgIDxkaXYgdi1pZj1cXFwiZm9jdXNPblxcXCIgY2xhc3M9XFxcInByZXZpZXctY29udGFpbmVyXFxcIj5cXG4gICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IEBjbGljaz1cXFwic2VsZWN0KHVuZGVmaW5lZClcXFwiIEBtb3VzZW92ZXI9XFxcImhvdmVyUGFuZWwgPSB0cnVlXFxcIiBAbW91c2VvdXQ9XFxcImhvdmVyUGFuZWwgPSBmYWxzZVxcXCIgOmNsYXNzPVxcXCJbJ3ByZXZpZXdlcicsICdyb3VuZGVkJywgeydjdXN0b20tc2hhZG93LXNtJzogIWhvdmVyUGFuZWx9LCB7J2N1c3RvbS1zaGFkb3cnOiBob3ZlclBhbmVsfSBdXFxcIj5cXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiB2LWZvcj1cXFwiKGksIGluZGV4KSBpbiBpY29uc0ZpbHRlcmVkXFxcIiA6a2V5PVxcXCJpbmRleFxcXCIgY2xhc3M9XFxcImljb24tcHJldmlld1xcXCI+XFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IEBjbGljay5wcmV2ZW50LnN0b3A9XFxcInNlbGVjdChpKVxcXCIgOmNsYXNzPVxcXCJbJ2ljb24td3JhcHBlcicsJ3JvdW5kZWQnLCdzaGFkb3ctc20nLCB7c2VsZWN0ZWQ6IGkudGl0bGUgPT0gc2VsZWN0ZWR9XVxcXCIgPlxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxpIDpjbGFzcz1cXFwiaS50aXRsZVxcXCIgLz5cXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvZGl2PlxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cXG4gICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cXG4gICAgICAgICAgICAgICAgICAgIDwvZGl2PlxcbiAgICAgICAgICAgICAgICA8L3RyYW5zaXRpb24+XFxuICAgICAgICAgICAgXFxuICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVxcXCJpY29uLXByZXZpZXctd3JhcFxcXCI+XFxuICAgICAgICAgICAgICAgICAgICA8bGFiZWwgc3R5bGU9XFxcIm1hcmdpbi1ib3R0b206IDBcXFwiPjwvbGFiZWw+XFxuICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVxcXCJpY29uLXByZXZpZXctaW5uZXJcXFwiIHN0eWxlPVxcXCJ3aWR0aDogNDBweDsgaGVpZ2h0OiA0MHB4O1xcXCI+XFxuICAgICAgICAgICAgICAgICAgICAgICAgPGkgY2xhc3M9XFxcIndwY2Z0b19nZW5lcmljX2ZpZWxkX19pY29ucGlja2VyX19pY29uXFxcIlxcbiAgICAgICAgICAgICAgICAgICAgICAgIHYtYmluZDpjbGFzcz1cXFwidmFsdWVcXFwiXFxuICAgICAgICAgICAgICAgICAgICAgICAgc3R5bGU9XFxcImZvbnQtc2l6ZTogMjRweDtcXFwiXFxuICAgICAgICAgICAgICAgICAgICAgICAgdi1pZj1cXFwidmFsdWUgJiYgdmFsdWUgIT09ICcnXFxcIj48L2k+ICBcXG4gICAgICAgICAgICAgICAgICAgICAgICA8c3BhbiB2LWVsc2U+LS08L3NwYW4+ICBcXG4gICAgICAgICAgICAgICAgICAgIDwvZGl2PiAgICAgICAgXFxuICAgICAgICAgICAgICAgICA8L2Rpdj5cXG4gICAgICAgICAgICAgPC9kaXY+XFxuXFxuICAgICAgICA8L2Rpdj5cXG4gIFwiLFxuICBtb3VudGVkOiBmdW5jdGlvbiBtb3VudGVkKCkge1xuICAgIHRoaXMudmFsdWUgPSB0aGlzLmZpZWxkX3ZhbHVlO1xuICAgIHRoaXMuc2VsZWN0ZWQgPSB0aGlzLnZhbHVlO1xuICAgIHRoaXMuaW5pdGVkID0gdHJ1ZTtcbiAgfSxcbiAgbWV0aG9kczoge1xuICAgIGJsdXI6IGZ1bmN0aW9uIGJsdXIoKSB7XG4gICAgICB2YXIgX3RoaXMgPSB0aGlzO1xuXG4gICAgICB0aW1lb3V0ID0gc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgICAgIF90aGlzLmZvY3VzT24gPSBmYWxzZTtcbiAgICAgICAgX3RoaXMudmFsdWUgPSAnJztcbiAgICAgIH0sIDEwMCk7XG4gICAgfSxcbiAgICBmb2N1czogZnVuY3Rpb24gZm9jdXMoKSB7XG4gICAgICB0aGlzLmZvY3VzT24gPSB0cnVlO1xuICAgIH0sXG4gICAgc2VsZWN0OiBmdW5jdGlvbiBzZWxlY3QoaWNvbikge1xuICAgICAgY2xlYXJUaW1lb3V0KHRpbWVvdXQpO1xuXG4gICAgICBpZiAoaWNvbikge1xuICAgICAgICBpZiAodGhpcy5zZWFyY2ggIT0gdGhpcy5zZWxlY3RlZCkgdGhpcy5iZWZvcmVTZWxlY3QgPSB0aGlzLnNlYXJjaDtcbiAgICAgICAgdGhpcy5zZWxlY3RlZCA9IGljb24udGl0bGU7XG4gICAgICAgIHRoaXMuc2VhcmNoID0gaWNvbi50aXRsZTtcbiAgICAgIH1cblxuICAgICAgdGhpcy5mb2N1c09uID0gZmFsc2U7XG4gICAgICB0aGlzLnZhbHVlID0gdGhpcy5zZWxlY3RlZDtcbiAgICB9XG4gIH0sXG4gIGNvbXB1dGVkOiB7XG4gICAgaWNvbnNGaWx0ZXJlZDogZnVuY3Rpb24gaWNvbnNGaWx0ZXJlZCgpIHtcbiAgICAgIHZhciBzZWFyY2ggPSB0aGlzLnNlYXJjaCA9PSB0aGlzLnNlbGVjdGVkID8gdGhpcy5iZWZvcmVTZWxlY3QgOiB0aGlzLnNlYXJjaDtcbiAgICAgIHJldHVybiB0aGlzLmljb25zLmZpbHRlcihmdW5jdGlvbiAoaSkge1xuICAgICAgICByZXR1cm4gaS50aXRsZS5pbmRleE9mKHNlYXJjaCkgIT09IC0xIHx8IGkuc2VhcmNoVGVybXMuc29tZShmdW5jdGlvbiAodCkge1xuICAgICAgICAgIHJldHVybiB0LmluZGV4T2Yoc2VhcmNoKSAhPT0gLTE7XG4gICAgICAgIH0pO1xuICAgICAgfSk7XG4gICAgfVxuICB9LFxuICB3YXRjaDoge1xuICAgIHZhbHVlOiB7XG4gICAgICBkZWVwOiB0cnVlLFxuICAgICAgaGFuZGxlcjogZnVuY3Rpb24gaGFuZGxlcih2YWx1ZSkge1xuICAgICAgICB0aGlzLiRlbWl0KCd3cGNmdG8tZ2V0LXZhbHVlJywgdmFsdWUpO1xuICAgICAgfVxuICAgIH1cbiAgfVxufSk7Il19
},{}]},{},[1])