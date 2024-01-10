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
    <form action="{{ url('/productForm') }}">
      <div class="d-flex justify-content-end" style="margin-right: 40px">
        <button class="btn btn-primary" name="create" type="submit">
          Add Product
        </button>
      </div>
    </form>
    <input name="" type="hidden" value="{{ $increment = 1 }}">
    <div class="container table-responsive py-5">
      <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th colspan="2" class="text-center">Action</th>

          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
            <tr>
                <td>{{ $increment }}</td>
                <td>
                <img src="storage/image/{{ $product->image }}" style="height : 30px; width : 30px" class="img-circle elevation-2" alt="Product Image">
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->sku_id }}</td>
                <td>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="btn btn-success dropdown-toggle"
                      data-bs-toggle="dropdown"
                    >
                      Select
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ url('/inventory/'.$product->id) }}">Go to Inventory</a></li>
                      <li><a class="dropdown-item" href="{{ url('/editProduct/'.$product->id) }}">Edit</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
          <input type="hidden" name="" value="{{ $increment += 1 }}">
          @endforeach    
        </tbody>
      </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  </body>
</html>
