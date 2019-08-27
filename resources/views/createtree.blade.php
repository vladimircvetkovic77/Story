<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      @include('layouts/headscripts')
      <title>Storyclash</title>
      @include('layouts/navigation')
      <!-- Styles -->
      <style>
         ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
         font-size: 13.5px;
         }
      </style>
   </head>
   <body>
      @csrf
      <div class="container" style="margin-top: 20px">
         <div class="row">
            <div class="col col-lg-4"  >
               <h5>
               Create tree  <i class="fas fa-tree" style="color: blue;"></i> </h3>
               <hr>
               <form>
                  <div class="form-group">
                     <label><strong>Tree name</strong></label>
                     <input name="treeName" id="treeName" type="text" class="form-control" placeholder="Enter tree item">
                     <span id="treeNameSpan" style="font-size: 11.5px; font-style: italic; color: grey;">Required field</span>
                  </div>
                  <div class="form-group">
                     <label><strong>Icon code (fontawesome)</strong></label>
                     <input name="treeIcon" id="treeIcon" type="text" class="form-control" placeholder="Icon html code">
                     <span id="treeIconSpan" style="font-size: 11.5px; font-style: italic; color: grey;">Copy fontawesome code here. If left blank standard icon will be used.</span>
                  </div>
                  <button id="treeFormButton" type="button" class="btn btn-primary" style="margin-top: 0px; ">Create tree</button>
               </form>
            </div>
            <!--  <div class="col col-lg-1" >
               </div> -->
            <div class="col col-lg-4" >
               <h5>
               Create branch  <i class="fab fa-pagelines" style="color: brown;"></i></h3>
               <hr>
               <form>
                  <div class="form-group">
                     <label for="exampleFormControlSelect1"><strong>Select tree</strong></label>
                     <div id="my1">
                        <div id="selectTree1">
                           <select name="tree_id" class="form-control" id="treeId">
                              <option disabled selected value> -- select an option -- </option>
                              @foreach($trees as $tree)
                              <option value="{{ $tree->id }}">{{$tree->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <label for="formGroupExampleInput" style="margin-top: 40px;"><strong>Branch name</strong></label>
                     <input type="text" class="form-control" id="branchName" name="branchName" placeholder="Enter branch item">
                     <span id="firstNameSpan" style="font-size: 11.5px; font-style: italic; color: grey;">Required field</span>
                  </div>
                  <div class="form-group">
                     <label for="formGroupExampleInput2"><strong>Icon code (fontawesome)</strong></label>
                     <input type="text" class="form-control" id="branchIcon" name="branchIcon" placeholder="Icon html code">
                     <span id="firstNameSpan" style="font-size: 11.5px; font-style: italic; color: grey;">Copy fontawesome code here. If left blank standard icon will be used.</span>
                  </div>
                  <button id="branchFormButton" type="button" class="btn btn-info">Create branch</button>
               </form>
            </div>
            <div class="col col-lg-4" >
               <h5>
               Create leaf  <i class="fas fa-leaf" style="color:green;"></i></h3>
               <hr>
               <form>
                  <div class="form-group">
                     <label for="exampleFormControlSelect1" style="margin-top: 0px;"><strong>Select branch</strong></label>
                     <div id="my3">
                        <div id="selectBranch1">
                           <select class="form-control" id="branchId" name="branch_id">
                              <option disabled selected value> -- select an option -- </option>
                              @foreach ($trees as $tree)
                              @foreach($tree->branches as $branch)
                              <option value="{{ $branch->id }}">{{$branch->tree->name}}   /  {{$branch->name}}</option>
                              @endforeach
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <label for="formGroupExampleInput" style="margin-top: 40px;"><strong>Leaf name</strong></label>
                     <input type="text" class="form-control" name="leafName" id="leafName" placeholder="Enter leaf item">
                     <span id="firstNameSpan" style="font-size: 11.5px; font-style: italic; color: grey;">Required field</span>
                  </div>
                  <div class="form-group">
                     <label for="formGroupExampleInput2"><strong>Icon code (fontawesome)</strong></label>
                     <input type="text" class="form-control" name="leafIcon" id="leafIcon"  placeholder="Icon html code">
                     <span id="firstNameSpan" style="font-size: 11.5px; font-style: italic; color: grey;">Copy fontawesome code here. If left blank standard icon will be used.</span>
                  </div>
                  <button id="leafFormButton" type="button" class="btn btn-success">Create leaf</button>
               </form>
            </div>
         </div>
      </div>
      </div>
      @include('layouts/messages')
      @include('layouts/bottomscripts')
   </body>
   <script>
      $(document).ready(function(){
        
        $("#treeFormButton").click(function(e){
      
                e.preventDefault();
      
                var name = $("input[name=treeName]").val();
                var icon = $("input[name=treeIcon]").val();
                var _token = $("input[name=_token]").val();
               
      
                $.ajax({
      
                       type:'post',
                       url:'store-tree',
                       data: {
                       name:name,
                       icon:icon,
                       _token:_token
      
                      },
      
                      success:function(data){
      
                            var treeAdded = data.success;
                            
                            $('#responseInfo').empty();
                            $('#responseSuccess').empty();
                            $('#responseError').empty();
                            $('#responseError').hide();
        
                    
                            if(treeAdded){
                            $('#responseSuccess').attr( "class", "alert alert-success" );
                            $('#responseSuccess').show().append('<i class="fas fa-check-circle"></i> '+treeAdded+"<br/>");
                            }
      
                           
      
                             $("#selectTree1").load(location.href+ ' #my1');
                             $("#selectTree2").load(location.href+ ' #my2');
                            $('#treeFormButton').blur();                  
                              $('#treeIcon').val("");
                              $('#treeName').val("");
            
      
                      },
      
                    error :function( data ) {
                        if( data.status === 422 ) {
                          var errors = $.parseJSON(data.responseText);
                          console.log(errors);
                          $('#responseError').empty();
                          $('#responseInfo').empty();
                           $('#responseInfo').hide();
                          $('#responseSuccess').empty();
                          $('#responseSuccess').hide();
                            $.each(errors, function (key, value) {
                                      
                                $('#responseError').attr( "class", "alert alert-danger" );
      
                                if($.isPlainObject(value)) {
                                      $.each(value, function (key, value) {                       
                                              
                                        $('#responseError').show().append('<i class="fas fa-exclamation-circle"></i>'+value+"<br/>");
                                      });
                                }
                            
                            });
                          
                        }
                       
                    }
               
                });
                                
          });
      
      
        $("#branchFormButton").click(function(e){
      
                e.preventDefault();
      
                var tree_id = $( "#treeId option:selected" ).val();
                var name = $("input[name=branchName]").val();
                var icon = $("input[name=branchIcon]").val();
                var _token = $("input[name=_token]").val();
               
               
      
                $.ajax({
      
                       type:'post',
                       url:'store-branch',
                       data: {
                       name:name,
                       icon:icon,
                       tree_id:tree_id,
                       _token:_token
      
                      },
      
                      success:function(data){
      
                            var branchAdded = data.success;
                            var branchExists = data.info;
      
                            
                            $('#responseInfo').empty();
                            $('#responseInfo').hide();
                            $('#responseSuccess').empty();
                            $('#responseSuccess').hide();
                            $('#responseError').empty();
                            $('#responseError').hide();
        
                    
                            if(branchAdded){
                            $('#responseSuccess').attr( "class", "alert alert-success" );
                            $('#responseSuccess').show().append('<i class="fas fa-check-circle"></i> '+branchAdded+"<br/>");
                            }
      
                            if(branchExists){
                            $('#responseInfo').attr( "class", "alert alert-info" );
                            $('#responseInfo').show().append('<i class="fas fa-info-circle"></i> '+branchExists+"<br/>");
                            }
      
                           
                            $("#selectTree1").load(location.href+ ' #my1');
                            $("#selectBranch1").load(location.href+ ' #my3');
                            $('#branchFormButton').blur();                  
                            $('#branchIcon').val("");
                            $('#branchName').val("");
            
      
                      },
      
                    error :function( data ) {
                        if( data.status === 422 ) {
                          var errors = $.parseJSON(data.responseText);
                          console.log(errors);
                          $('#responseError').empty();
                          $('#responseInfo').empty();
                          $('#responseInfo').hide();
                          $('#responseSuccess').empty();
                          $('#responseSuccess').hide();
                            $.each(errors, function (key, value) {
                                      
                                $('#responseError').attr( "class", "alert alert-danger" );
      
                                if($.isPlainObject(value)) {
                                      $.each(value, function (key, value) {                       
                                              
                                        $('#responseError').show().append('<i class="fas fa-exclamation-circle"></i>'+value+"<br/>");
                                      });
                                }
                            
                            });
                          
                        }
                       
                    }
               
                });
                                
          });
      
        $("#leafFormButton").click(function(e){
      
                e.preventDefault();
      
                var name = $("input[name=leafName]").val();
                var icon = $("input[name=leafIcon]").val();
                var branch_id = $("#branchId option:selected").val();
                var _token = $("input[name=_token]").val();
               
                console.log(branch_id);
      
                $.ajax({
      
                       type:'post',
                       url:'store-leaf',
                       data: {
                       name:name,
                       icon:icon,
                       branch_id:branch_id,
                       _token:_token
      
                      },
      
                      success:function(data){
      
                            var leafAdded = data.success;
                            
                            $('#responseInfo').empty();
                            $('#responseSuccess').empty();
                            $('#responseError').empty();
                            $('#responseError').hide();
        
                    
                            if(leafAdded){
                            $('#responseSuccess').attr( "class", "alert alert-success" );
                            $('#responseSuccess').show().append('<i class="fas fa-check-circle"></i> '+leafAdded+"<br/>");
                            }
      
                           
                            $("#selectTree1").load(location.href+ ' #my1');
                            $("#selectBranch1").load(location.href+ ' #my3');
                            $('#leafFormButton').blur();                  
                            $('#leafIcon').val("");
                            $('#leafName').val("");
            
      
                      },
      
                    error :function( data ) {
                        if( data.status === 422 ) {
                          var errors = $.parseJSON(data.responseText);
                          console.log(errors);
                          $('#responseError').empty();
                          $('#responseInfo').empty();
                           $('#responseInfo').hide();
                          $('#responseSuccess').empty();
                          $('#responseSuccess').hide();
                            $.each(errors, function (key, value) {
                                      
                                $('#responseError').attr( "class", "alert alert-danger" );
      
                                if($.isPlainObject(value)) {
                                      $.each(value, function (key, value) {                       
                                              
                                        $('#responseError').show().append('<i class="fas fa-exclamation-circle"></i>'+value+"<br/>");
                                      });
                                }
                            
                            });
                          
                        }
                       
                    }
               
                });
                                
          });
      
      
         $('#responseError').click(function(event) {
      
          $("#responseError").css("display", "").hide('fast');
             
        });
      
      
        $('#responseInfo').click(function(event) {
      
          $("#responseInfo").css("display", "").hide('fast');
             
        });
      
        $('#responseSuccess').click(function(event) {
      
          $("#responseSuccess").css("display", "").hide('fast');
             
        });
         
      
        });
      
      
   </script>
</html>