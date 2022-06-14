let timeout = undefined;
let icons = wpcfto_icons_set;

Vue.component('consulting_icon_picker', {
    props: ['fields', 'field_label', 'field_name', 'field_id', 'field_value', 'field_data'],
    data: function () {
        return {
            value: '',
            focusOn: false,
            icons: icons,
            hoverPanel: false,
            search: "",
            beforeSelect: "",
            selected: "",
            inited: false
        }
    },
    template: `
        <div class="wpcfto_generic_field wpcfto_generic_field_iconpicker">

            <wpcfto_fields_aside_before :fields="fields" :field_label="field_label"></wpcfto_fields_aside_before>
            
            <div class="wpcfto-field-content">
                <div class="wpcfto_generic_field__inner">
    
                    <div class="wpcfto_generic_field" style="width: 100%;">
                        <label style="margin-bottom: 0"></label>
                        <input ref="picker"
                        v-model="search"
                        @blur="blur"
                        @focus="focus"
                        type="text"
                        class="form-control"
                        placeholder="Search an icon">
                    </div>
          
                </div>
    
                <transition name="icon-preview-fade">
                    <div v-if="focusOn" class="preview-container">
                        <div @click="select(undefined)" @mouseover="hoverPanel = true" @mouseout="hoverPanel = false" :class="['previewer', 'rounded', {'custom-shadow-sm': !hoverPanel}, {'custom-shadow': hoverPanel} ]">
                            <div v-for="(i, index) in iconsFiltered" :key="index" class="icon-preview">
                                <div @click.prevent.stop="select(i)" :class="['icon-wrapper','rounded','shadow-sm', {selected: i.title == selected}]" >
                                    <i :class="i.title" />
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            
                 <div class="icon-preview-wrap">
                    <label style="margin-bottom: 0"></label>
                    <div class="icon-preview-inner" style="width: 40px; height: 40px;">
                        <i class="wpcfto_generic_field__iconpicker__icon"
                        v-bind:class="value"
                        style="font-size: 24px;"
                        v-if="value && value !== ''"></i>  
                        <span v-else>--</span>  
                    </div>        
                 </div>
             </div>

        </div>
  `,
    mounted: function () {
        this.value = this.field_value;
        this.selected = this.value;
        this.inited = true;
    },
    methods: {
        blur() {
            timeout = setTimeout(() => {
                this.focusOn = false;
                this.value = '';
            }, 100);
        },
        focus() {
            this.focusOn = true;
        },
        select(icon) {
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
        iconsFiltered: function () {
            const search = (this.search == this.selected) ? this.beforeSelect : this.search
            return this.icons.filter(i =>
                i.title.indexOf(search) !== -1 || i.searchTerms.some(t => t.indexOf(search) !== -1)
            )
        }
    },
    watch: {
        value: {
            deep: true,
            handler: function (value) {
                this.$emit('wpcfto-get-value', value);
            }
        }
    }
});
