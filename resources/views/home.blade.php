@extends('layout')

@section('content')
    <div class="container">
         <a href="{{route('books.create') }}" class="btn btn-primary"  style="margin-bottom: 10px; float: right">Новая книга</a>
        @if(count($books)!=0)
        @if($errors->any())
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&#10006</span>
                        </button>
                        {{$errors->first() }}
                    </div>
                </div>
            </div>
        @endif
        @if(session('success'))
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&#10006</span>
                        </button>
                        {{session()->get('success') }}
                    </div>
                </div>
            </div>
        @endif
<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Фото</th>
								<th scope="col">Имя</th>
								<th scope="col">Автор</th>
								<th scope="col">Категория</th>
								<th scope="col">Метка или тег</th>
								<th scope="col">Полка</th>
								<th scope="col">Наличие книги</th>
							</tr>
						</thead>
						<tbody>
                        @php /** @var \App\Models\Book $item */  @endphp
                        @foreach($books as $book)
							<tr>
								<th scope="row">{{$book->id}}</th>
                                @if($book->picture != null)
								<td><img src="public{{$url = Storage::url($book->picture['name'])}}" style="width: 50px;"></td>
                                @else
                                    <td><img src="public/storage/nopicture.png" class="picture" style="width: 50px;"></td>
                                @endif

								<td><a href="{{route('books.edit', $book->id) }}">{{$book->name }}</a></td>
								<td>{{$book->author}}</td>
                                <td> @foreach ($book->categories as $category)
                                        {{ $category->name }}
                                    @endforeach</td>
								<td>@foreach ($book->tags as $tag)
                                    {{ $tag->name }}
                                    @endforeach</td>
								<td>{{$book->shelf['name']}}</td>
								<td>
                                    @if(isset($book->journal['status']))
                                        {{$book->journal['status']}}
                                        @if($book->journal['status'] == "У читателя")
                                            <br>
                                            <span>Вернется: <br> {{$book->journal['date_return']}}</span>
                                        @endif
                                    @else
                                        <span>В наличии</span>
                                    @endif
                                </td>
							</tr>
                        @endforeach
						</tbody>
					</table>
				</div><!-- ./table-responsive-->
    </div>
    @endif
@endsection


