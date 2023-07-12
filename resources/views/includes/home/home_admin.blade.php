 <!-- Info boxes -->
 <div class="row">
     <a href="{{route("users.index")}}" class="col-12 col-sm-6 col-md-3">
         <div class="info-box">
             <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
             <div class="info-box-content">
                 <span class="info-box-text">Usuarios</span>
                 <span class="info-box-number">{{ $usuarios }}</span>
             </div>
             <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
     </a>
     <a href="{{route("personals.index")}}" class="col-12 col-sm-6 col-md-3">
         <div class="info-box">
             <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
             <div class="info-box-content">
                 <span class="info-box-text">Personal</span>
                 <span class="info-box-number">{{ $personals }}</span>
             </div>
             <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
     </a>
     <!-- /.col -->
     <a href="{{route("obras.index")}}" class="col-12 col-sm-6 col-md-3">
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
     <!-- /.col -->

     <!-- fix for small devices only -->
     <div class="clearfix hidden-md-up"></div>

     <a href="{{route("herramientas.index")}}" class="col-12 col-sm-6 col-md-3">
         <div class="info-box mb-3">
             <span class="info-box-icon bg-success elevation-1"><i class="fas fa-list"></i></span>

             <div class="info-box-content">
                 <span class="info-box-text">Herramientas</span>
                 <span class="info-box-number">0</span>
             </div>
             <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
     </a>

     <!-- /.col -->
 </div>
 <!-- /.row -->
