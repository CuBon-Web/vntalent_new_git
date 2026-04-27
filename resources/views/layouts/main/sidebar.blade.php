<div class="widget">
   <h4 class="title">Yêu cầu tư vấn</h4>
   <form id="commentform" method="POST" action="{{ route('customer-leads.store') }}">
      @csrf
      <input type="hidden" name="quick_form" value="1">
      <input type="hidden" name="quick_source" value="form-sidebar">
      <div class="row">
         <div class="col-md-12">
            <div class="form-group">
               <div class="form-icon">
                  <i class="far fa-user-tie"></i>
                  <input type="text" class="form-control" name="name" placeholder="Họ Tên" value="{{ old('name') }}" required>
               </div>
            </div>
         </div>
         <div class="col-md-12">
            <div class="form-group">
               <div class="form-icon">
                  <i class="far fa-phone"></i>
                  <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}" required>
               </div>
            </div>
         </div>
         <div class="col-md-12">
            <div class="form-group">
               <div class="form-icon">
                  <i class="far fa-envelope"></i>
                  <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
               </div>
            </div>
         </div>
  

       <div class="col-md-12">
          <div class="form-group">
             <div class="form-icon">
                <i class="far fa-note"></i>
                <textarea name="consultation_content" class="form-control" id="" cols="30" rows="10" placeholder="Ghi chú">{{ old('consultation_content') }}</textarea>
             </div>
          </div>
       </div>
         <div class="col-md-12 mt-2">
            <button type="submit" class="theme-btn"><span class="loader ml-15 spin-icon"></span> Gửi yêu cầu</button>
         </div>
      </div>
   </form>
</div>