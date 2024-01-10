<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ url('/css/style.css') }}" />
    <title>Product Inventory</title>
  </head>
  <body>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('warning'))
        <div class="alert alert-danger">
            {{Session::get('status')}}
        </div>
    @elseif (Session::has('status'))
        <div class="alert alert-success">
            {{Session::get('status')}}
        </div>	
    @endif
    <div class="d-flex justify-content-center">
      <form action="{{ url('/update-product') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" placeholder="ID" value="{{ $product->id }}">
        <div class="pt-2">
          <div class="input-group mb-3">
            <input
              type="text"
              autocomplete="off"
              placeholder="Product Name"
              name="name"
              value="{{ $product->name }}"
              class="form-control"
              aria-label="productName"
              aria-describedby="basic-addon1"
            />
          </div>
        </div>
        <div class="col">
          <div class="input-group mb-3">
            <input
              type="text"
              autocomplete="off"
              placeholder="description"
              name="description"
              value="{{ $product->description }}"
              class="form-control"
              aria-label="description"
              aria-describedby="basic-addon1"
            />
          </div>
        </div>
        <div class="col" style="position: relative">
            <div class="input-group mb-3">
              <input
                type="file"
                autocomplete="off"
                placeholder="Image"
                name="image"
                class="form-control"
                aria-label="image"
                aria-describedby="basic-addon1"
              />
            </div>
            <p style="position: absolute; top: 7px; right: 20px">{{ $product->image ?: 'No image selected' }}</p>
        </div>
        <div class="row pt-2">
          <div class="col">
            <div class="input-group mb-3">
              <input
                type="text"
                autocomplete="off"
                placeholder="Color"
                name="color"
                value="{{ $product->color }}"
                class="form-control"
                aria-label="color"
                aria-describedby="basic-addon1"
              />
            </div>
          </div>
          <div class="col">
            <div class="input-group mb-3">
              <input
                type="number"
                min="1"
                autocomplete="off"
                placeholder="price"
                name="price"
                value="{{ $product->price }}"
                class="form-control"
                aria-label="price"
                aria-describedby="basic-addon1"
              />
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center">
            <button class="btn btn-success" name="create" type="submit">
                Update Product
              </button>
        </div>
      </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  </body>
</html>
