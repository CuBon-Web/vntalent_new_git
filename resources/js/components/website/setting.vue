<template>
  <div>
      <h3 class="page-title">Cài đặt chung</h3>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" >
                <div class="form-group">
                  <label>Tên doanh nghiệp</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.company"
                  />
                </div>
                <div class="form-group">
                  <label>Tên website</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.webname"
                  />
                </div>
                <div class="form-group">
                  <label>Văn phòng đại diện</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.address1"
                  />
                </div>
                <div class="form-group">
                  <label>Địa chỉ</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.address2"
                  />
                </div>
                <div class="form-group">
                  <label>Số điện thoại 1</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.phone1"
                  />
                </div>
                <div class="form-group">
                  <label>Số điện thoại 2</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.phone2"
                  />
                </div>
                <div class="form-group">
                  <label>Fax</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.fax"
                  />
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.email"
                  />
                </div> 
                <div class="form-group">
                  <label>Facebook</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.facebook"
                  />
                </div>
                <div class="form-group">
                  <label>Iframe GG map</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.iframe_map"
                  />
                </div>
                <div class="form-group">
                  <label>Favicon</label>
                  <image-upload type="avatar" v-model="objData.favicon" :title="'favicon'"></image-upload>
                </div>
                <div class="form-group">
                  <label>Logo</label>
                  <image-upload type="avatar" v-model="objData.logo" :title="'logo'"></image-upload>
                </div>
                <div class="form-group">
                  <label>Logo chân trang</label>
                  <image-upload type="avatar" v-model="objData.fbPixel" :title="'logo'"></image-upload>
                </div>
                <div class="form-group">
                <label>FAQ</label>
                <div v-for="(item, index) in objData.footer_content" :key="index">
                  <div class="row">
                    <div class="col-11" >
                      <vs-input
                        type="text"
                        size="default"
                        :placeholder="'Danh mục ' + index"
                        class="w-100"
                        v-model="objData.footer_content[index].fagcate"
                        disabled
                      />

                      <div v-for="(i, keys) in objData.footer_content[index].fag_detail" :key="keys">
                        <div class="row">
                          <div class="col-1" style="text-align: right;padding: 6px 4px;">
                            <a
                              href="javascript:;"
                              v-if="keys != 0"
                              @click="remoteDetailTaskr(index,keys)"
                              
                            >
                              <img v-bind:src="'/media/' + joke.avatar" width="25" />
                            </a>
                          </div>
                          <div class="col-11" style="padding: 6px 0px;">
                            <vs-input style="margin-bottom: 3px;"
                              type="text"
                              size="default"
                              :placeholder="'Tiêu đề ' + keys"
                              class="w-100"
                              v-model="objData.footer_content[index].fag_detail[keys].name"
                            /> <br>
                            <!-- <vs-textarea :placeholder="'Nội dung ' + keys" v-model="objData.footer_content[index].fag_detail[keys].content" /> -->
                            <TinyMce
                              :placeholder="'Nội dung ' + keys"
                              v-model="objData.footer_content[index].fag_detail[keys].content"
                            />
                          </div>
                        </div>
                        
                      </div>
                      <div class="row">
                        <div class="col-12" style="text-align: right;padding: 6px 0;">
                          <el-button size="small" @click="addDetailTask('footer_content',index)" >Thêm câu hỏi</el-button>
                        </div>
                      </div>
                      
                    </div>
                    <div class="col-1">
                      <a
                        href="javascript:;"
                        v-if="index != 0"
                        @click="remoteAr(index,'footer_content')"
                      >
                        <img v-bind:src="'/media/' + joke.avatar" width="25" />
                      </a>
                    </div>
                  </div>
                </div>

                <!-- <el-button size="small" @click="addInput('footer_content')"
                  >Thêm danh mục FAG</el-button
                > -->
              </div> 
              <vs-button color="primary" @click="saveSetting">Lưu</vs-button>
            </div>
          </div>
        </div>
      </div>
    <!-- content-wrapper ends -->
  </div>
</template>


<script>
import { mapActions } from "vuex";
import { required } from "vuelidate/lib/validators";
import TinyMce from "../_common/tinymce";
export default {
  name: "setting",
  data() {
    return {
      joke: {
        avatar: "delete-sign--v2.png",
      },
      objData:
        {
            webname : "",
            company : "",
            address1: "",
            address2 : "",
            phone1 : "",
            phone2 : "",
            fax : "",
            email : "",
            facebook : "",
            google : "",
            GA : "",
            fbPixel : "",
            iframe_map : "",
            favicon : "",
            logo : "",
            footer_content:[
                  {
                  fagcate: "",
                  fag_detail: [
                    {
                      name: "",
                      content:"",
                    }
                  ]
                },
            ],
            popupimage:"",
            statusPopup:1,
            linkpopup:""
        }
    };
  },
  components: {
    TinyMce
  },
  computed: {},
  watch: {},
  methods: {
    ...mapActions(["postSetting", "loadings","getSetting"]),
    saveSetting(){
      this.loadings(true);
      this.postSetting(this.objData).then(response => {
        this.loadings(false);
        this.$success('Cài đặt thành công');
      }).catch(error => {
        this.loadings(false);
        this.$error('Cài đặt thất bại');
      })
    },
    remoteAr(index,key) {
      if(key == 'footer_content'){
        this.objData.footer_content.splice(index, 1);
      }
    },
    addDetailTask(key,index){
      var oj = {};
      if(key =='footer_content'){
        oj.name = "";
        oj.content = "";
        this.objData.footer_content[index].fag_detail.push(oj);
      }
    },
    addInput(key) {
        var oj = {};
        if(key =='footer_content'){
          oj.fagcate = "";
          oj.fag_detail = [
              {
                name: "",
                content:""
              }
            ];
          this.objData.footer_content.push(oj);
        }
    },
    remoteDetailTaskr(index,keytaskdetail) {
        this.objData.footer_content[index].fag_detail.splice(keytaskdetail, 1);
    },
    listSettings(){
      this.loadings(true);
      this.getSetting().then(response => {
        this.loadings(false);
        this.objData = response.data;
        if(response.data.footer_content == null){
            this.objData.footer_content = [{
              fagcate: "",
              fag_detail: [
              {
                name: "",
                content:""
              }
            ]
          }]
          }else{
            this.objData.footer_content = JSON.parse(response.data.footer_content);
          }
      }).catch(error => {
        this.loadings(false);;
      })
    }
  },
  mounted() {
    this.listSettings();
  }
};
</script>