@extends('layouts.app')

@section('content')
<div class="container"   >

   <div class="row justify-content-center" >

     <div class="container">




        <!-- /.col-lg-3 -->

        <div class="col-lg-12 ">



          <template>
                  <!-- object value -->
                  <model-select :options="options"
                                          v-model="item"
                                          placeholder="select item">
                   </model-select>

                   <!-- string value -->
                   <model-select :options="options2"
                                           v-model="item2"
                                           placeholder="select item2">
                   </model-select>
          </template>

          <script>
            import { ModelSelect } from 'vue-search-select'

            export default {
              data () {
                return {
                  options: [
                    { value: '1', text: 'aa' + ' - ' + '1' },
                    { value: '2', text: 'ab' + ' - ' + '2' },
                    { value: '3', text: 'bc' + ' - ' + '3' },
                    { value: '4', text: 'cd' + ' - ' + '4' },
                    { value: '5', text: 'de' + ' - ' + '5' }
                  ],
                  item: {
                    value: '',
                    text: ''
                  },
                  options2: [
                    { value: '1', text: 'aa' + ' - ' + '1' },
                    { value: '2', text: 'ab' + ' - ' + '2' },
                    { value: '3', text: 'bc' + ' - ' + '3' },
                    { value: '4', text: 'cd' + ' - ' + '4' },
                    { value: '5', text: 'de' + ' - ' + '5' }
                  ],
                  item2: ''
                }
              },
              methods: {
                reset () {
                  this.item = {}
                },
                selectOption () {
                  // select option from parent component
                  this.item = this.options[0]
                },
                reset2 () {
                  this.item2 = ''
                },
                selectOption2 () {
                  // select option from parent component
                  this.item2 = this.options2[0].value
                }
              },
              components: {
                ModelSelect
              }
            }
          </script>
  </div>


  </div>


       </div>
       </div>

<br>
<br>
@endsection

@push('scripts')
<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction1() {
    document.getElementById("myDropdown1").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

@endpush
