<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      @include('layouts/headscripts')
      <title>Search</title>
      @include('layouts/navigation')
      <style type="text/css">
         *.unselectable {
         -moz-user-select: none;
         -khtml-user-select: none;
         -webkit-user-select: none;
         -ms-user-select: none;
         user-select: none;
         }
         .hide {
         visibility: hidden;
         }

         .lowOpacity {
        
          opacity: 0.3;
          color: greyt;
         
        

         }


         input,
         label {
           display: inline-block;
           margin-bottom: 0; 
           vertical-align: middle; 
         }
        


      </style>
   </head>
   <body>
      @csrf
      <div class="containter unselectable">
         <div class="content-wrapper    unselectable" style="margin: 30px;">
            <form>
               <input class="form-control" id="searchField" type="" name="search" placeholder="Search" aria-label="Search" style="width: 300px; margin: 30px;">
               <!--  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            </form>
            <div id="myDiv" style="min-height: 100px;">
               <div id="loader" style="display:none; margin: 0 auto;">
                  <div class="spinner-grow text-primary"></div>
                  <div class="spinner-grow text-primary"></div>
                  <div class="spinner-grow text-primary"></div>
               </div>
               @foreach($list as $maintree)
               <nav role='navigation'>
                  <div class="tree unselectable" unselectable="on">
                     <ul style="list-style: none;">
                        <li>
                           <input type="checkbox" id="{{$maintree->id}}" class="treeCheckBox">
                           <input type="checkbox" id="{{$maintree->id}}" class="lowOpacity treeCheckBox2" style="display: none">
                           <strong><label class="treeLabel" id="{{$maintree->id}}">  &nbsp;&nbsp; {!! $maintree->icon !!} &nbsp;&nbsp;{{ $maintree->name }} <small> 
                           @if( $maintree->branches->count()) 
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <a class="treeLabel treePlus-{{$maintree->id}} unselectable"><i class="fas fa-angle-down treeLabel" id="{{$maintree->id}}" style="color: blue; font-size: 15px;"></i></a>
                           <a class="treeLabel treeMinus-{{$maintree->id}} unselectable" style="display: none; color: blue; font-size: 15px;"><i class="fas fa-angle-right treeLabel" id="{{$maintree->id}}" ></i></a>  
                           @endif </small></label></strong> 
                           @foreach($maintree->branches as $branch)
                           <div class="branch maintree-{{ $maintree->id }} unselectable" id="maintree-{{ $maintree->id }}" unselectable="on">
                              <ul style="list-style: none;">
                                 <li>

                                    <input type="checkbox" name="branchBox" id="{{$branch->id}}" class="branchCheckBox maintree-{{ $maintree->id }}" style="margin-bottom: px;">
                                    <input type="checkbox" id="{{$branch->id}}" class="lowOpacity branchCheckBox2 maintree-{{ $maintree->id }}" style="display: none">
                                    <label class="branchLabel" id="{{$branch->id}}">  &nbsp;&nbsp; {!! $branch->icon !!} &nbsp;&nbsp; {{ $branch->name }} <small> 
                                    @if( $branch->leaves->count()) 
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="branchLabel branchPlus-{{$branch->id}} unselectable"><i class="fas fa-angle-right branchLabel" id="{{$branch->id}}" style="color: blue; font-size: 15px;"></i></a>
                                    <a class="branchLabel branchMinus-{{$branch->id}} unselectable" style="display: none; color: blue; font-size: 15px;"><i class="fas fa-angle-down branchLabel" id="{{$branch->id}}" ></i></a>  
                                    @endif 
                                    </small></label>
                                 </li>
                                 @foreach($branch->leaves as $leaf)
                                 <div class="leaf branch-{{ $branch->id }} maintree-{{ $maintree->id }}" style="display:none" id="branch-{{ $branch->id }}" unselectable="on">
                                    <ul style="list-style: none;">
                                       <li id="list">
                                          <input type="checkbox" id="{{$leaf->id}}" class="leafCheckBox maintree-{{$maintree->id}} branchCb-{{$branch->id}} ">
                                          <label> &nbsp;&nbsp; {!! $leaf->icon !!} &nbsp;&nbsp; {{ $leaf->name }}</label>
                                       </li>
                                    </ul>
                                 </div>
                                 @endforeach
                              </ul>
                           </div>
                           @endforeach
                        </li>
                     </ul>
                  </div>
               </nav>
               @endforeach
               <button type="button" class="btn btn-danger" style="margin-left: 35px;">Cancel</button>
               <button type="button" class="btn btn-success">Apply</button>
            </div>
         </div>
      </div>
      @include('layouts/messages') @include('layouts/bottomscripts')
   </body>
   <script>
      $(document).ready(function() {
      
       
          $( "#myDiv" ).on( "click", ".treeLabel", function( event ) {
              event.preventDefault();
              var value = event.target.id;
             
              $('.maintree-' + value).toggle();
              $('.treeMinus-' + value).toggle();
              $('.treePlus-' + value).toggle();
      
          });
      
          
          $( "#myDiv" ).on( "click", ".branchLabel", function( event ) {
              event.preventDefault();
              var value = event.target.id;
             
              $('.branch-' + value).toggle();
              $('.branchPlus-' + value).toggle();
              $('.branchMinus-' + value).toggle();
      
          });
      
          $("#searchField").on('keyup', function(){
             var value = $(this).val();
             $.ajax({
              type : 'get',
              url : 'livesearch',
              data : {
                 search:value
      
             },
             success : function(data){
                
                $('#myDiv').html(data);
              
            }
      
      
              });
      
         });


          $( "#myDiv" ).on( "click", ".treeCheckBox", function( event ) {
            var value = event.target.id;
           
            if ($(this).is(':checked')) {

            $( ".maintree-"+value ).prop( "checked", true );
              
            }else{
              $( ".maintree-"+value ).prop( "checked", false );
            }
          });

            
          $( "#myDiv" ).on( "click", ".branchCheckBox", function( event, leaf_cancel = true) {
            var value = event.target.id;
           
            if (leaf_cancel){

                if ($(this).is(':checked')) {

                $( ".branchCb-"+value ).prop( "checked", true );
                  
                }else{
                   $( ".branchCb-"+value ).prop( "checked", false );
                }

            }
          });

          
          $( "#myDiv" ).on( "click", ".leafCheckBox", function( event ) {
            var value = event.target.id;
            
            if ($(this).is(':checked')) {

                      
                      var leafBrotherBoxes =  $(this).parent().parent().parent().attr('id');
                      var unchecked = 0;

                      $('div#'+leafBrotherBoxes+' input[type=checkbox]').each(function() {
                                if (!$(this).is(":checked")) {
                                   
                                   ++unchecked;
                                   
                               }
                      });

                    console.log('unchecked: '+unchecked);
                      if (unchecked) {

                          $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").hide();
                          $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").show();
                          $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").prop( "checked", true );
                         


                      }else{

                          $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").show();
                          $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").hide();
                          $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").prop( "checked", true );
                           $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").chechForParent();
                          
                      }

            }


            else{ 
                       
                       var checked = 0;
                       var not_checked =0;

                       var leafBrotherBoxes =  $(this).parent().parent().parent().attr('id');
                       var testparent =  $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox").attr('id');
                       console.log(testparent);
                        $('div#'+leafBrotherBoxes+' input[type=checkbox]').each(function() {
                                
                                if ($(this).is(":checked")) {
                                   
                                   ++checked;   
                                }else{
                                  ++not_checked;
                                }
                        });

                         console.log('not checked: '+not_checked);

                         if (checked) {

                          console.log('hit');
                          $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").hide();
                           $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").prop( "checked", false );

                          $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox").hide();
                          $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox2").show();
                          $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox2").prop( "checked", true );
                          $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").show();
                          $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").prop( "checked", true );

                           if (not_checked) {

                                $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox").show();
                                $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox2").hide();
                                $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().find(".treeCheckBox").prop( "checked", false );
                                 $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").chechForParent();
                               
                           }

                          

                      }else{

                          $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").show();
                          $(this).parent().parent().parent().parent().parent().find(".branchCheckBox2").hide();
                          $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").prop( "checked", false );
                          $(this).parent().parent().parent().parent().parent().find(".branchCheckBox").chechForParent();
                     

                      }
            }


          });

          $( "#myDiv" ).on( "click", ".branchCheckBox", function treeCheck( event ) {
            
            var value = event.target.id;
            
            if ($(this).is(':checked')) {

                      
                      var branchBrotherBoxes =  $(this).parent().parent().parent().attr('id');
              
                      var unchecked = 0;

                      $('div#'+branchBrotherBoxes+' input[name=branchBox]').each(function() {
                                if (!$(this).is(":checked")) {
                                   
                                   ++unchecked;
                                   
                               }
                      });
                    
                      if (unchecked) {

                          $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").hide();
                          $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").show();
                          $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").prop( "checked", true );

                      }else{

                          $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").show();
                          $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").hide();
                          $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop( "checked", true );

                      }

            }


            else{ 
                       
                       var checked = 0;
                       var branchBrotherBoxes =  $(this).parent().parent().parent().attr('id');
                       
                        $('div#'+branchBrotherBoxes+' input[name=branchBox]').each(function() {
                                
                                if ($(this).is(":checked")) {
                                   
                                   ++checked;   
                                }
                        });

                        

                         if (checked) {

                          $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").hide();
                          $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop( "checked", false );
                          $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").show();
                          $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").prop( "checked", true );


                      }else{

                          $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").show();
                          $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").hide();
                          $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop( "checked", false );

                      }
            }


          });



          $( "#myDiv" ).on( "click", ".branchCheckBox2", function( event ) {
              event.preventDefault();
              var value = event.target.id;
            
              $(this).hide();
              $('#'+value).show().prop( "checked", true );

             if ($('#'+value).is(':checked')) {
                  var value1 = event.target.id;
                 
                 $( ".branchCb-"+value1 ).prop( "checked", true );
              
             }else{
               $( ".branchCb-"+value1 ).prop( "checked", false );
             }

          $(this).chechForParent();
          });


          $( "#myDiv" ).on( "click", ".treeCheckBox2", function( event ) {
              event.preventDefault();
              var value = event.target.id;
            
              $(this).hide();
              $('#'+value).show().prop( "checked", true );

             if ($('#'+value).is(':checked')) {
                  var value1 = event.target.id;

                $( ".maintree-"+value1 ).filter(".branchCheckBox").show();
                 $( ".maintree-"+value1 ).filter(".branchCheckBox").prop( "checked", true );
                   $( ".maintree-"+value1 ).filter(".branchCheckBox2").hide();
                 $( ".maintree-"+value1 ).filter(".branchCheckBox2").prop( "checked", false );

              
                 $( ".maintree-"+value1 ).prop( "checked", true );
              
             }else{
               $( ".maintree-"+value1 ).prop( "checked", false );
             }

        
          });




          $.fn.chechForParent = function() {
              
              if ($(this).is(':checked')) {

                                   
                                   var branchBrotherBoxes =  $(this).parent().parent().parent().attr('id');
                           
                                   var unchecked = 0;

                                   $('div#'+branchBrotherBoxes+' input[name=branchBox]').each(function() {
                                             if (!$(this).is(":checked")) {
                                                
                                                ++unchecked;
                                                
                                            }
                                   });
                                 
                                   if (unchecked) {

                                       $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").hide();
                                        $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop( "checked", false );
                                       $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").show();
                                       $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").prop( "checked", true );

                                   }else{

                                       $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").show();
                                       $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").hide();
                                       $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop( "checked", true );

                                   }

                         }


                         else{ 
                                    
                                    var checked = 0;
                                    var branchBrotherBoxes =  $(this).parent().parent().parent().attr('id');
                                    
                                     $('div#'+branchBrotherBoxes+' input[name=branchBox]').each(function() {
                                             
                                             if ($(this).is(":checked")) {
                                                
                                                ++checked;   
                                             }
                                     });

                                     

                                      if (checked) {

                                       $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").hide();
                                        $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop( "checked", false );
                                       $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").show();
                                       $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").prop( "checked", true );


                                   }else{

                                       $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").show();
                                       $(this).parent().parent().parent().parent().parent().find(".treeCheckBox2").hide();
                                       $(this).parent().parent().parent().parent().parent().find(".treeCheckBox").prop( "checked", false );

                                   }
                         }
          };


      
      });
   </script>
</html>