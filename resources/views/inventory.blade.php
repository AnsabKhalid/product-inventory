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
    <h4 class="d-flex align-items-center justify-content-center my-4">Add Inventory</h4>
    <div class="d-flex justify-content-center">
      <form class="w-50" action="{{ url('/addInventory') }}" method="post">
        {{ csrf_field() }}
        <div class="pt-2">
          <div class="input-group mb-3">
            <input
              type="text"
              autocomplete="off"
              placeholder="Product ID"
              name="product_id"
              value="{{ $product->id }}"
              class="form-control"
              aria-label="productId"
              aria-describedby="basic-addon1"
              readonly
            />
          </div>
        </div>
        <div class="row pt-2">
          <div class="col">
            <div class="input-group mb-3">
              <input
                type="number"
                min="1"
                autocomplete="off"
                placeholder="Quantity"
                name="quantity"
                value=""
                class="form-control"
                aria-label="quantity"
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
                value=""
                class="form-control"
                aria-label="price"
                aria-describedby="basic-addon1"
              />
            </div>
          </div>
        </div>
        <div class="row pt-2">
          <div class="col">
            <div class="input-group mb-3">
              <input
                type="date"
                autocomplete="off"
                placeholder="Select Date"
                name="date"
                value=""
                class="form-control"
                aria-label="productId"
                aria-describedby="basic-addon1"
              />
            </div>
          </div>
          <div class="col">
            <div class="input-group mb-3">
              <select
                class="form-select form-select-sm py-2"
                aria-label="form-select-sm example"
                name="type"
                style="width: 514px;"
              >
                <option value="" disabled selected>Please Select Product Type</option>
                <option value="in">In</option>
                <option value="out">Out</option>
              </select>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <button class="btn btn-success" name="create">
            Submit
          </button>
        </div>
      </form>
    </div>
    <div class="row mx-5">
      <h3 class="d-flex align-items-center justify-content-center">About Product</h3>
      
      <div class="col-md-12 mt-4">
        <div class="d-flex align-content-center justify-content-center">
          <img src="{{ asset('storage/image/' . $product->image) }}" style="height : 150px;" class="img-circle elevation-2" alt="Product Image">
        </div>
        <div class="mt-4 d-flex flex-column align-items-center justify-content-center">
          <p class=""><span class="" style="font-size: 20px; font-weight: 700">Name:</span> {{ $product->name }}</p>
          <p class=""><span class="" style="font-size: 20px; font-weight: 700">SKU:</span> {{ $product->sku_id }}</p>
        </div>
      </div>
    </div>
    <input name="" type="hidden" value="{{ $increment = 1 }}">
    <div class="container table-responsive py-5">
      <h3 class="d-flex align-items-center justify-content-center">Total Inventory</h3>
      <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Cost per item</th>
            <th>Total Amount</th>
            <th>Date</th>

          </tr>
        </thead>
        <tbody>
          @php
          // Quantity
            $totalInQuantity = 0;
            $totalOutQuantity = 0;

          // Price
            $totalInPrice = 0;
            $totalOutPrice = 0;
          @endphp
          @foreach($inventories as $inventory)
            <tr>
                <td>{{ $increment }}</td>
                <td>{{ $inventory->type == 'in' ? 'Bought' : 'Sold' }}</td>
                <td>{{ $inventory->quantity }}</td>
                <td>{{ $inventory->price }}</td>
                <td>{{ $inventory->quantity * $inventory->price }}</td>
                <td>{{ \Carbon\Carbon::parse($inventory->date)->format('d/m/Y') }}</td>
              </tr>

              @if($inventory->type == 'in')
                @php
                  $totalInQuantity += $inventory->quantity;
                  $totalInPrice += $inventory->price;
                @endphp
              @elseif($inventory->type == 'out')
                @php
                  $totalOutQuantity += $inventory->quantity;
                  $totalOutPrice += $inventory->price;
                @endphp
              @endif

          <input type="hidden" name="" value="{{ $increment += 1 }}">
          @endforeach    
        </tbody>
      </table>
      
        <div class="row mt-4">
          <div class="d-flex justify-content-between">
            <div class="mt-4 d-flex flex-column">
              <p class=""><span class="text-uppercase" style="font-size: 16px; font-weight: 700">Total Bought Quantity:</span> {{ $totalInQuantity }}</p>
              <p class=""><span class="text-uppercase" style="font-size: 16px; font-weight: 700">Total Sold Quantity:</span> {{ $totalOutQuantity }}</p>
              <p class=""><span class="text-uppercase" style="font-size: 16px; font-weight: 700">In Stock:</span> {{ $totalInQuantity - $totalOutQuantity }}</p>
            </div>
            <div class="mt-4 d-flex flex-column">
              <p class=""><span class="text-uppercase" style="font-size: 16px; font-weight: 700">Investment:</span> {{ $totalInPrice }}</p>
              <p class=""><span class="text-uppercase" style="font-size: 16px; font-weight: 700">Return:</span> {{ $totalOutPrice }}</p>

              @php
                $totalProfit = $totalOutPrice - $totalInPrice;
              @endphp

              <p class=""><span class="text-uppercase" style="font-size: 16px; font-weight: 700">Profit:</span>
                @if($totalProfit < 0)
                  @php
                    $totalProfit = 0;
                  @endphp
                @endif
                {{ $totalProfit }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
