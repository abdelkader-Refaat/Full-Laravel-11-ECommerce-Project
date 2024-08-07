@extends('admin.master')

@section('title')
    {{trans('master.category')}}
  @endsection

 @section('content')

 <a class="flex justify-center" href="{{route('categories.create')}}"><button type="button" class= " text-green-600 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-green-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">{{__('category.create')}}</button></a>

     {{-- table  --}}
     <div class="">
        <div class="block">
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>

                <tr>
                  <th>#</th>
                  <th> {{__('category.Name')}}</th>
                  <th> {{__('category.Description')}}</th>
                  <th> {{__('category.image')}}</th>
                  <th>{{__('category.status')}}</th>
                  <th>{{__('category.popular')}}</th>
                  <th class="flex justify-center">{{__('category.Action')}}</th>

                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                @foreach ($categories as $category)


                <tr>
                  <th scope="row">{{$i++}}</th>
                  <td>{{$category->name}}</td>
                  <td>{{Str::limit($category->description,10)}}</td>
                  <td><img class="rounded-full w-10 h-10" src="{{Storage::url($category->image)}}" alt="" ></td>
                  <td>
                        @if ($category->is_showing == 1)
                        <span class="mt-2 bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{__('category.showing')}}</span>
                        @else
                        <span class="mt-2 bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{__('category.hidden')}}</span>

                        @endif
                    </td>
                  <td>
                    @if ($category->is_popular == 1)
                    <span class="mt-2 bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{__('category.populars')}}</span>
                    @else
                    <span class="mt-2 bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{__('category.notpopular')}}</span>

                    @endif
                </td>
                  <td class="flex justify-center">
                  <a href="{{ route('categories.show',$category->id) }}">  <button type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">{{__('category.show')}}</button></a>
                   <a href="{{route('categories.edit',$category->id )}}"> <button type="button" class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">{{__('category.edit')}}</button></a>
                   <form action="{{route('categories.destroy',$category->id)}}" method="Post" >
                    @csrf
                    @method("DELETE")
                    <input type="hidden" class="deleteCategory" value="{{ $category->id }}">
                  <button  type="submit" class="deletebutton text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">{{__('category.delete')}}</button>

                    </form>


                  </td>
                </tr>

                @endforeach

              </tbody>
            </table>
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path fill="currentColor" fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm5.178 12.137a4.137 4.137 0 1 1 1.036-8.144A6.113 6.113 0 0 0 8.726 12c0 1.531.56 2.931 1.488 4.006a4.114 4.114 0 0 1-1.036.131ZM10.726 12c0-1.183.496-2.252 1.294-3.006A4.125 4.125 0 0 1 13.315 12a4.126 4.126 0 0 1-1.294 3.006A4.126 4.126 0 0 1 10.726 12Zm4.59 0a6.11 6.11 0 0 1-1.489 4.006 4.137 4.137 0 1 0 0-8.013A6.113 6.113 0 0 1 15.315 12Z" clip-rule="evenodd"/>
              </svg>


          </div>
        </div>
      </div>

@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.deletebutton').click(function(e) {
                e.preventDefault();
                var delete_id = $(this).closest("form").find('.deleteCategory').val();


                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this category!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            var data = {
                                "_token" :  $('input[name="csrf-token"]').val(),
                                "id"  : delete_id,
                            };
                            $.ajax({
                                type: "DELETE",
                                url: '/admin/categories/' + delete_id,
                                data: data,
                                success: function(response) {
                                    swal(response.status, {
                                      icon: "success",

                                    }).then((result) => {
                                        location.reload();

                                    });
;
                                }

                            });
                        }
                    });
            });
        });
    </script>
@endsection
     @endsection
