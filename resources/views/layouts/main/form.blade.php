<form id="baogia" >
    <div class="row">
       <div class="col-md-6 col-6">
          <div class="wc-input">
             <span>Họ Tên:</span>
             <div class="wc-text-input position-relative">
                <input class="form-control" name="name" type="text" placeholder="Nguyễn Văn A">
             </div>
          </div>
       </div>
       <div class="col-md-6 col-6">
          <div class="wc-input">
             <span>Số Điện Thoại:</span>
             <div class="wc-text-input position-relative">
                <input class="form-control" name="phone" type="text" placeholder="0978451254">
             </div>
          </div>
       </div>
       <div class="col-md-6 col-6">
          <div class="wc-input">
             <span>Tên Hàng:</span>
             <div class="wc-text-input position-relative">
                <input class="form-control" name="tenhang" type="text" placeholder="Gia Dụng, Thời Trang...">
             </div>
          </div>
       </div>
       <div class="col-md-6 col-6">
          <div class="wc-input">
             <span>Khối Lượng:</span>
             <div class="wc-text-input position-relative">
                <input class="form-control" name="khoiluong" type="text" placeholder="1 Tấn..">
             </div>
          </div>
       </div>
       <div class="col-md-6 col-6">
          <div class="wc-input">
             <span>Điểm bốc:</span>
             <div class="wc-text-input position-relative">
                <input class="form-control" name="diemboc" type="text" placeholder="Hải Phòng">
             </div>
          </div>
       </div>
       <div class="col-md-6 col-6">
          <div class="wc-input">
             <span>Điểm trả:</span>
             <div class="wc-text-input position-relative">
                <input class="form-control" name="diemtra" type="text" placeholder="Hà nội">
             </div>
          </div>
       </div>
       <div class="col-md-6 col-6">
          <div class="wc-input">
             <span>Ngày cần chuyển:</span>
             <div class="wc-text-input position-relative">
                <input class="form-control" name="ngaycanchuyen" type="text" placeholder="25/2/2024">
             </div>
          </div>
       </div>
       <div class="col-md-6 col-6">
          <div class="wc-input">
             <span>Cước đề xuất:</span>
             <div class="wc-text-input position-relative">
                <input class="form-control" name="cuocdexuat" type="text" placeholder="VD: 3 Triệu">
             </div>
          </div>
       </div>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fa fa-spinner fa-spin spin-icon" aria-hidden="true"></i> Gửi</button>
 </form>
 <script>
    $('#baogia').validate({
                rules: {
                   "name": {
                      required: true,
                   },
                   "phone": {
                      required: true,
                      minlength: 8
                   },
                   "tenhang": {
                      required: true,
                   },
                   "khoiluong": {
                      required: true,
                   },
                   "diemboc": {
                      required: true,
                   },
                   "diemtra": {
                      required: true,
                   },
                   "ngaycanchuyen": {
                      required: true,
                   }
                },
                messages: {
                   "name": {
                      required: "Tên bạn là gì?",
                   },
                   "phone": {
                      required: "Nhập sdt liên hệ",
                   },
                   "tenhang": {
                      required: "Hàng bạn muốn vận chuyển là gì?",
                   },
                   "khoiluong": {
                      required: "Khối lượng hàng khoảng bao nhiêu?",
                   },
                   "diemboc": {
                      required: "Điểm bốc hàng của bạn là gì?",
                   },
                   "diemtra": {
                      required: "Điểm trả hàng của bạn là gì?",
                   },
                   "ngaycanchuyen": {
                      required: "Ngày bạn cần chuyển hàng?",
                   }
                },
             submitHandler: function(form) {
                $(".spin-icon").css("display", "block");
                $.ajax({
                 url: "https://script.google.com/macros/s/AKfycbxOY64wKFA2hVQa5gnXd9ZvXYigvKkpGdl9Plh3eZSAo0grZjiEZqm6PelpkMU5lKt3/exec",
                 type: "post",
                 data: $("#baogia").serializeArray(),
                 success: function () {
                    $(".spin-icon").css("display", "none");
                    $('#exampleModal').modal('hide');
                   jQuery.notify("Thành công! Chúng tôi sẽ sớm liên hệ", "success");
                 },
                 error: function () {
                   jQuery.notify("Gửi thông tin thất bại", "error");
                 }
              });
             }
             });
 </script>