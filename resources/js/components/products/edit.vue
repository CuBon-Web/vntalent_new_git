<template>
  <div>
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label>Tên trường</label>
              <vs-input
                type="text"
                size="default"
                placeholder="Trường Trung học Maruawai College – Southland, New Zealand.."
                class="w-100"
                v-model="objData.name"
              />
            </div>
            <div class="form-group">
              <label>Nội dung</label>
              <TinyMce
                v-model="objData.content[0].content"
              />
              <el-button size="small" @click="showSettingLangExist('content')">Đa ngôn ngữ</el-button>
               <div class="dropLanguage" v-if="showLang.content == true">
                  <div class="form-group" v-for="item,index in lang" :key="index">
                      <label v-if="index != 0">{{item.name}}</label>
                      <TinyMce v-if="index != 0" v-model="objData.content[index].content" />
                  </div>
              </div>
            </div>
            <div class="form-group">
              <label>Mô tả ngắn</label>
              <vs-textarea v-model="objData.description[0].content" />
              <el-button size="small" @click="showSettingLangExist('description')">Đa ngôn ngữ</el-button>
               <div class="dropLanguage" v-if="showLang.description == true">
                  <div class="form-group" v-for="item,index in lang" :key="index">
                      <label v-if="index != 0">{{item.name}}</label>
                      <vs-textarea v-if="index != 0" v-model="objData.description[index].content" />
                  </div>
              </div>
            </div>
            <div class="form-group">
              <label>Ảnh Trường</label>
              <ImageMulti v-model="objData.images" :title="'san-pham'"/> 
            </div>
            <div class="row">
            <div class="form-group col-6">
              <label>Chi phí tham khảo</label>
              <vs-input
                type="number"
                size="default"
                icon="all_inclusive"
                class="w-100"
                v-model="objData.price"
              />
            </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label>Trạng thái</label>
              <vs-select v-model="objData.status">
                <vs-select-item value="1" text="Còn hàng" />
                <vs-select-item value="0" text="Hết hàng" />
              </vs-select>
            </div>
            <div class="form-group">
              <label>Quốc Gia</label>
              <vs-select
                class="selectExample w-100"
                v-model="objData.category"
                placeholder="Danh mục"
              >
              <vs-select-item
                  value="0"
                  text="Không danh mục"
                />
                <vs-select-item
                  :value="item.id"
                  :text="JSON.parse(item.name)[0].content"
                  v-for="(item, index) in cate"
                  :key="'f' + index"
                />
              </vs-select>
            </div>
            <div class="form-group">
              <label>Cấp học</label>
              <vs-select
                placeholder="Multiple"
                multiple
                class="selectExample w-100"
                v-model="objData.preserve"
                >
                <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in caphoc" />
              </vs-select>
            </div>
            <div class="form-group">
              <label>Thẻ tags cho Trường</label>
              <vs-select
                  multiple
                  class="selectExample w-100"
                  v-model="objData.tags"
                  placeholder="--Chọn--"
                  >
                  <div :key="index" v-for="item,index in tags">
                    <vs-select-group :title="item.name" v-if="item.tags">
                      <vs-select-item :key="index" :value="i.id" :text="i.name" v-for="i,index in item.tags"/>
                    </vs-select-group>
                  </div>
              </vs-select>
            </div>
            <div class="form-group">
              <label>Xếp hạng THEWU</label>
              <vs-input
                type="text"
                size="default"
                placeholder="0"
                class="w-100"
                v-model="objData.ingredient"
              />
            </div>
            <div class="form-group">
              <label>Xếp hạng QS</label>
              <vs-input
                type="text"
                size="default"
                placeholder="0"
                class="w-100"
                v-model="objData.species"
              />
            </div>
            <div class="form-group">
              <label>Xếp hạng AROWU</label>
              <vs-input
                type="text"
                size="default"
                placeholder="0"
                class="w-100"
                v-model="objData.origin"
              />
            </div>
            <div class="form-group">
              <label>Chỉ số đang dạng</label>
              <vs-input
                type="text"
                size="default"
                placeholder="0"
                class="w-100"
                v-model="objData.thickness"
              />
            </div>
            <div class="form-group">
              <label>Chỉ số đồng hương</label>
              <vs-input
                type="text"
                size="default"
                placeholder="0"
                class="w-100"
                v-model="objData.hang_muc"
              />
            </div>
            <div class="form-group">
              <label>Tổng điểm</label>
              <div v-for="(item, index) in objData.size" :key="index">
                <div class="row">
                  <div class="col-11">
                    <vs-input
                      type="text"
                      size="default"
                      :placeholder="'Tiêu đề ' + index"
                      class="w-100"
                      v-model="objData.size[index].title"
                    />
                    <vs-input
                      type="text"
                      size="default"
                      :placeholder="'Giá trị ' + index"
                      class="w-100"
                      v-model="objData.size[index].detail"
                    />
                    <br />
                  </div>
                  <div class="col-1">
                    <a
                      href="javascript:;"
                      v-if="index != 0"
                      @click="remoteAr(index,'size')"
                    >
                      <img v-bind:src="'/media/' + joke.avatar" width="25" />
                    </a>
                  </div>
                </div>
              </div>

              <el-button size="small" @click="addInput('size')"
                >Thêm thông số</el-button
              >
            </div>
            <div class="form-group">
              <label>Trường nổi bật</label>
              <vs-select v-model="objData.discountStatus">
                <vs-select-item value="1" text="Có" />
                <vs-select-item value="0" text="Không" />
              </vs-select>
            </div>
          </div>
        </div> 
      </div>
    </div>
    <div class="row fixxed">
      <div class="col-12">
        <div class="saveButton">
          <vs-button color="primary" @click="saveProducts"
            >Thêm mới</vs-button
          >
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
import ImageMulti from "../_common/upload_image_multi";
import "tinymce/icons/default/icons.min.js";
import InputTag from "vue-input-tag";
export default {
name: "product",
data() {
  return {
    cate: [],
    caphoc:[
        {text:'THPT',value:'thpt'},
        {text:'Cao đẳng',value:'cao-dang'},
        {text:'Dự bị đại học',value:'du-bi-dai-hoc'},
        {text:'Đại học',value:'dai-hoc'},
        {text:'Sau đại học',value:'sau-dai-hoc'},
        {text:'Học tiếng',value:'hoc-tieng'},
        {text:'Đào tạo nghề',value:'dao-tao-nghe'},
      ],
    joke: {
      avatar: "delete-sign--v2.png",
    },
    type_cate: [],
    tags: [],
    checkBox1:{
      roleid:[]
    },
    linhtinh:[],
    
    type_two:[],
    showLang: {
      title: false,
      content: false,
      description: false,
    },
    variant_value:[],
    variant:[],
    variant_item:{},
    variantstatus:false,
    lang: [],
    errors: [],
    cateservice:[],
    cate_build_pc:[
      {
        name: 'Vi xử lý',
        value:'cpu'
      },
      {
        name: 'Bo mạch chủ',
        value:'mainboard'
      },
      {
        name: 'Ram',
        value:'ram'
      },
      {
        name: 'Ổ Cứng',
        value:'o-cung'
      },
      {
        name: 'VGA',
        value:'vga'
      },
      {
        name: 'Nguồn',
        value:'nguon'
      },
      {
        name: 'Vỏ Case',
        value:'case'
      },
      {
        name: 'Tản nhiệt',
        value:'tan-nhiet'
      },
      {
        name: 'Màn hình',
        value:'man-hinh'
      },
      {
        name: 'Bàn phím',
        value:'ban-phim'
      },
      {
        name: 'Chuột',
        value:'chuot'
      },
      {
        name: 'Tai nghe',
        value:'tai-nghe'
      },
      {
        name: 'Loa máy tính',
        value:'loa-may-tinh'
      }
    ],
    objData: {
      id: this.$route.params.id,
      lang: "",
      variant:[],
      name: "",
      size: [
        {
          title: "Tổng điểm",
          detail: ""
        },
        {
          title: "Thu nhập từ nghiên cứu",
          detail: ""
        },
        {
          title: "Giảng dạy",
          detail: ""
        },
        {
          title: "Nghiên cứu",
          detail: ""
        },
        {
          title: "Triển vọng quốc tế",
          detail: ""
        },
        {
          title: "Tầm ảnh hưởng của các nghiên cứu",
          detail: ""
        }
      ],
      cate_build_pc:"",
      tags:[],
      price: 0,
      discount: 0,
      preserve:[],
      ingredient:'',
      images: [],
      qty: "",
      description: [
        {
          lang_code: "vi",
          content: "",
        },
      ],
      content: [
        {
          lang_code: "vi",
          content: "",
        },
      ],
      category: 0,
      status: 1,
      discountStatus:0,
      type_cate: 0,
      type_two:0,
      species:"",
      origin: "",
      thickness: "",
      hang_muc: "",
      service_id:0,
      home_status: 0
    },
  };
},
components: {
  TinyMce,
  ImageMulti,
  InputTag
},
computed: {},
watch: {
},
methods: {
  ...mapActions([
    "editId",
    "saveProduct",
    "listCate",
    "loadings",
    "listLanguage",
    "findTypeCate",
    "findTypeCateTwo",
    "listCateService",
    "listTagsPro"
  ]),


  
  saveProducts() {
    this.errors = [];
   if(this.objData.name == '') this.errors.push('Tên không được để trống');
    if(this.objData.images.length == 0) this.errors.push('Vui lòng chọn ảnh');
    if(this.objData.category == 0) this.errors.push('Chọn danh mục Trường');
    if (this.errors.length > 0) {
      this.errors.forEach((value, key) => {
        this.$error(value);
      });
      return;
    } else {
      this.loadings(true);
      this.objData.lungtung = this.lungtung2;
      this.saveProduct(this.objData)
        .then((response) => {
          this.loadings(false);
          this.$router.push({ name: "listProduct" });
          this.$success("Thêm Trường thành công");
          this.$route.push({ name: "listProduct" });
        })
        .catch((error) => {
          this.loadings(false);
          // this.$vs.notify({
          //   title: "Thất bại",
          //   text: "Thất bại",
          //   color: "danger",
          //   position: "top-right"
          // });
        });
    }
  },
  
  findCategoryType() {
    this.findTypeCate(this.objData.category).then((response) => {
      this.type_cate = response.data;
    });
  },
  listTag(){
    this.listTagsPro().then((response) => {
      this.tags = response.data;
    });
  },
  findCategoryTypeTwo() {
    this.findTypeCateTwo(this.objData.type_cate).then((response) => {
      this.type_two = response.data;
    });
  },
  remoteAr(index,key) {
    if(key == 'size'){
      this.objData.size.splice(index, 1);
    }
  },
  addInput(key) {
      var oj = {};
      if(key =='size'){
        oj.title = "";
        oj.detail = "";
        this.objData.size.push(oj);
      }
  },
  showSettingLangExist(value, name = "content") {
    if (value == "content") {
      this.showLang.content = !this.showLang.content;
      this.lang.forEach((value, index) => {
        if (
          !this.objData.content[index] &&
          value.code != this.objData.content[0].lang_code
        ) {
          var oj = {};
          oj.lang_code = value.code;
          oj.content = "";
          this.objData.content.push(oj);
        }
      });
    }
    if (value == "description") {
      this.showLang.description = !this.showLang.description;
      this.lang.forEach((value, index) => {
        if (
          !this.objData.description[index] &&
          value.code != this.objData.description[0].lang_code
        ) {
          var oj = {};
          oj.lang_code = value.code;
          oj.content = "";
          this.objData.description.push(oj);
        }
      });
    }
  },
  listLang() {
    this.listLanguage()
      .then((response) => {
        this.loadings(false);
        this.lang = response.data;
      })
      .catch((error) => {});
  },
  editById() {
    this.loadings(true);
    this.editId({id:this.$route.params.id}).then(response => {
      this.loadings(false);
        this.objData = response.data;
        this.objData.images = JSON.parse(response.data.images);
        this.objData.content = JSON.parse(response.data.content);
        this.objData.description = JSON.parse(response.data.description);
        this.objData.tags = JSON.parse(response.data.tags);
        this.objData.preserve = JSON.parse(response.data.preserve);
        if(JSON.parse(response.data.size)[0].detail == null){
          this.objData.size = [{title: "Chiều cao",detail: ""},{title: "Chất liệu",detail: ""}]
        }else{
          this.objData.size = JSON.parse(response.data.size);
        }
    }).catch(error => {
      console.log(12);
    });
  },
},
mounted() {
  this.loadings(true);
  this.editById();
  this.listCate().then((response) => {
    this.loadings(false);
    this.cate = response.data;
  });
   this.listCateService().then((response) => {
    this.loadings(false);
    this.cateservice = response.data;
  });
  this.listTag();
  this.listLang();
},
};
</script>
<style scoped>
.centerx li {
  list-style: none!important;
}
.centerx, .con-notifications, .con-notifications-position {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
}
.selectExample {
margin: 10px;
}
.con-select-example {
display: flex;
align-items: center;
justify-content: center;
}
.con-select .vs-select {
width: 100%
}
@media (max-width: 550px) {
.con-select {
  flex-direction: column;
}
.con-select .vs-select {
  width: 100%
}
}
</style>