      <section class="subscribe_section">
         <div class="container-fuild">
            <div class="box">
               <div class="row">
                  <div class="col-md-6 offset-md-3">
                     <div class="subscribe_form ">
                        <div class="heading_container heading_center">
                           <h3>Comment</h3>
                        </div>
                        <p>Write your comment here, respecting the opinions of others</p>
                        <form action="{{ url('add_comment') }}" method="post">
                           @csrf
                           <input type="text" placeholder="Enter your Comment" name="comment" required minlength="10">
                           <button>
                           Add Comment
                           </button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>