 <!-- Info boxes -->
 <div class="row">
     <a href="{{ route('obras.index') }}" class="col-12 col-sm-6 col-md-3">
         <div class="info-box mb-3">
             <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-list-alt"></i></span>

             <div class="info-box-content">
                 <span class="info-box-text">Obras</span>
                 <span class="info-box-number">{{ $obras }}</span>
             </div>
             <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
     </a>
 </div>
 <!-- /.row -->
