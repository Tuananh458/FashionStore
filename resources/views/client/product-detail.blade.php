@extends('layouts.client')
@push('css')
  <link href="{{ asset('asset/client/css/bootstrap_min.css') }}" rel="stylesheet">
@endpush
@section('content-client')

<style>
  .rating .fa-star {
    color: #b1b1b1;
  }

  .preview-small {
    margin-top: unset !important;
  }

  .quantyti_sold {
    font-size: 14px !important;
  }

  .products-description div {
    font-size: 14px;
    line-height: 20px;
  }

  h5 {
    font-weight: bold;
    margin-bottom: 5px;
  }

  input[type="number"]::-webkit-outer-spin-button,
  input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    /* Ẩn mũi tên trên Chrome/Safari */
    margin: 0;
  }

  input[type="number"] {
    -moz-appearance: textfield;
    /* Ẩn mũi tên trên Firefox */
  }

  /* Fix thumbnail size */
  .thumbnail-fixed {
    width: 100px;
    height: 100px;
    object-fit: cover;
  }

  /* Style for color options (square with text) */
  .color-option {
    width: 50px;
    height: 35px;
    border: 2px solid transparent;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    font-size: 12px;
    text-align: center;
    cursor: pointer;
    margin-right: 10px;
    position: relative;
    transition: border 0.3s ease;
  }

  .color-option .color-box {
    width: 100%;
    height: 100%;
    border-radius: 5px;
    position: absolute;
    top: 0;
    left: 0;
  }

  .color-option span {
    position: relative;
    z-index: 1;
    color: white;
    font-weight: bold;
    text-shadow: 0px 0px 3px rgba(0, 0, 0, 0.5);
  }

  .color-option.selected {
    background: linear-gradient(90deg, #ff9a9e, #fad0c4, #fbc2eb);
    /* Viền gradient */
    border: 3px solid transparent;
    animation: pulse 1.5s infinite;
    /* Hiệu ứng nhấp nháy */
    position: relative;
    z-index: 1;
  }

  .color-option.selected .color-box {
    z-index: 0;
    filter: brightness(120%);
  }

  /* Keyframes for pulsing effect */
  @keyframes pulse {
    0% {
      box-shadow: 0 0 5px rgba(255, 105, 135, 0.6);
    }

    50% {
      box-shadow: 0 0 15px rgba(255, 105, 135, 0.8);
    }

    100% {
      box-shadow: 0 0 5px rgba(255, 105, 135, 0.6);
    }
  }

  /* Size button styles */
  .size-btn,
  .color-btn {
    display: inline-flex;
    /* Hoặc flex nếu muốn kiểm soát layout */
    align-items: center;
    /* Căn giữa theo chiều dọc */
    justify-content: center;
    /* Căn giữa theo chiều ngang */
    text-align: center;
    width: 40px;
    height: 40px;
    font-size: 10px;
    border-radius: 5px;
    border: 1px solid black;
    margin-top: 5px;
  }

  .size-btn.selected,
  .color-btn.selected {
    background-color: black;
    color: white;
  }

  .quantity-control {
    display: flex;
    align-items: center;
    max-width: 150px;
    margin-top: 15px;
  }

  .quantity-control input {
    width: 60px;
    text-align: center;
    font-size: 16px;
    border: 1px solid #ccc;
    height: 40px;
  }

  .quantity-control button {
    width: 40px;
    height: 40px;
    background-color: #f8f9fa;
    border: 1px solid #ccc;
    font-size: 18px;
    line-height: 1;
    cursor: pointer;
  }

  .quantity-control button:hover {
    background-color: #e9ecef;
  }

  .carousel-control-prev:hover {
    border: none !important;
  }

  .carousel-control-next:hover {
    border: none !important;
  }
</style>
<div class="container_fullwidth">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="products-details">
          <div class="col-md-6">
            <!-- Carousel -->
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="{{ asset("asset/client/images/products/small/$product->img") }}"
                    class="d-block w-100 rounded" alt="Product Image 1">
                </div>
                @foreach ($productColor as $color)
          <div class="carousel-item">
            <img src="{{ asset("asset/client/images/products/small/$color->img") }}" class="d-block w-100 rounded"
            alt="Product Image 1">
          </div>
        @endforeach
              </div>
              <!-- Controls -->
              <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>

            <!-- Thumbnails -->
            <div class="d-flex mt-3">
              <img src="{{ asset("asset/client/images/products/small/$product->img") }}"
                class="img-thumbnail me-2 thumbnail-fixed" alt="Thumbnail 1" data-bs-target="#productCarousel"
                data-bs-slide-to="0">
              @foreach ($productColor as $index => $color)
          <img src="{{ asset("asset/client/images/products/small/$color->img") }}"
          class="img-thumbnail me-2 thumbnail-fixed" alt="Thumbnail {{$index + 2}}"
          data-bs-target="#productCarousel" data-bs-slide-to="{{ $index + 1 }}">
        @endforeach
            </div>
          </div>
          <div class="col-md-6">
            <h1 class="fw-bold">{{ $product->name }}</h1>
            <p style="margin-top:20px;font-size:large;">
              <span
                class="text-muted text-decoration-line-through">{{ format_number_to_money($product->price_sell) }}<sup>
                  VNĐ
                </sup></span>
              <span class="text-danger fw-bold"
                style="color:red!important;">{{ format_number_to_money($product->price_import) }}<sup>
                  VNĐ
                </sup> </span>
            </p>

            <form action="{{ route('cart.store') }}" method="POST">
              @csrf
              <!-- Chọn Màu Sắc -->
              <div class="mb-3">
                <h5>COLOR</h5>
                <div class="d-flex gap-2" id="color-options">
                  @foreach ($productColor as $color)
            <button type="button" class="btn btn-outline-dark color-btn" data-color="{{ $color->color_name }}">
            {{ $color->color_name }}
            </button>
          @endforeach
                </div>
              </div>

              <!-- Chọn Kích Thước -->
              <div class="mb-3">
                <h5>SIZE</h5>
                <div class="d-flex gap-2" id="size-options" data-sizes="{{ json_encode($productSize) }}">
                  <!-- Nút kích thước sẽ được JavaScript cập nhật -->
                </div>
                <!-- Trường ẩn để lưu thông tin kích thước đã chọn -->
                <input type="hidden" id="selected-size-id" name="id">
              </div>

              <!-- Số Lượng -->
              <div class="mb-3">
                <h5>Quantity</h5>
                <div class="quantity-control d-flex align-items-center gap-2">
                  <button type="button" id="decrease-qty" class="btn btn-outline-dark">-</button>
                  <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control w-auto"
                    style="border-radius:0px;">
                  <button type="button" id="increase-qty" class="btn btn-outline-dark">+</button>
                </div>
              </div>

              <!-- Nút Thêm Vào Giỏ Hàng -->
              <button class="btn btn-dark btn-lg w-100 mb-4">ADD TO CART</button>
            </form>


          </div>

        </div>
        <div class="clearfix">
        </div>
        <div id="productsDetails" class="hot-products">
          <h3 class="title">
            Sản Phẩm Liên Quan
          </h3>
          <ul>
            <li>
              <div class="row">
                @foreach ($relatedProducts as $relatedProduct)
          <div class="col-md-3 col-sm-6">
            <div class="product-card">
            <a href="{{ route('user.products_detail', $relatedProduct->id) }}">
              <img src="{{ asset("asset/client/images/products/small/$relatedProduct->img") }}" alt=""
              class="product-image">
            </a>
            <div class="product-details">
              <a href="{{ route('user.products_detail', $relatedProduct->id) }}">
              <h3 class="product-brand">{{ $relatedProduct->brand_name }}</h3>
              <p class="product-name">{{ $relatedProduct->name }}</p>
              </a>
              <p class="product-price">{{ format_number_to_money($relatedProduct->price_sell) }} VNĐ</p>
              <div class="product-rating">
              <x-avg-stars :number="$relatedProduct->avg_rating" />
              <span class="sold-quantity">Đã bán: {{ $relatedProduct->sum }}</span>
              </div>
            </div>
            </div>
          </div>
        @endforeach
              </div>
            </li>
          </ul>
        </div>
        <div class="clearfix">
        </div>
        <div class="review-summary">
          <div class="rating-count">Khách hàng đánh giá ({{ count($productReviews) }})</div>
          <div class="rating">
            @for($i = 1; $i <= floor($avgRating); $i++)
        <i class="fas fa-star"></i>
      @endfor
            @if (!is_int($avgRating))
        <i class="fas fa-star-half-alt"></i>
      @endif
            <span>{{ number_format($avgRating, 1) }} / 5.0</span>
          </div>
        </div>
        @if ($checkReviewProduct)
      <div class="write-review">
        <button>Viết đánh giá</button>
      </div>
      <form method="POST" action="{{ route('product_review.store', $product->id) }}">
        @csrf
        <div class="review_container">
        <div class="review-title">Bạn cảm thấy sản phẩm như thế nào?</div>
        <div class="stars">
          <input class="star" type="radio" hidden id="star1" value="1" />
          <label for="star1" title="Poor" id="icon-star1">
          <i class="far fa-star"></i>
          </label>
          <input class="star" type="radio" hidden id="star2" value="2" />
          <label for="star2" title="Fair" id="icon-star2">
          <i class="far fa-star"></i>
          </label>
          <input class="star" type="radio" hidden id="star3" value="3" />
          <label for="star3" title="Good" id="icon-star3">
          <i class="far fa-star"></i>
          </label>
          <input class="star" type="radio" hidden id="star4" value="4" />
          <label for="star4" title="Very Good" id="icon-star4">
          <i class="far fa-star"></i>
          </label>
          <input class="star" type="radio" hidden id="star5" value="5" />
          <label for="star5" title="Excellent" id="icon-star5">
          <i class="far fa-star"></i>
          </label>
          <input type="hidden" name="rating">
        </div>
        <div class="instruction">Hãy cho chúng tôi biết trải nghiệm sản phẩm từ bạn</div>
        <div class="review-content">
          <label for="reviewText">Nội dung đánh giá sản phẩm</label>
          <textarea id="reviewText" placeholder="Nhập nội dung đánh giá sản phẩm" name="content"></textarea>
        </div>
        <button class="submit-button" type="submit">Xác nhận đánh giá</button>
        </div>
      </form>
    @endif
        @if (count($productReviews) > 0)
      <div class="review-list">
        @foreach ($productReviews as $productReview)
      <div class="review-item">
      <div class="reviewer">{{ $productReview->user_name }}</div>
      <div class="rating">
        <x-stars number="{{ $productReview->rating }}" />
      </div>
      <div class="date">{{ $productReview->created_at }}</div>
      <div class="content">{{ $productReview->content }}</div>
      </div>
    @endforeach
      </div>
      @if (count($productReviews) > 0)
      <div class="text-center">
      <ul class="pagination">
      {{ $productReviews->links('vendor.pagination.default') }}
      </ul>
      </div>
    @endif
    @else
    <p class="text-center review-comment-null">Chưa có đánh giá nào</p>
  @endif
        <div class="clearfix">
        </div>
      </div>
      <div class="clearfix">
      </div>
    </div>
  </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // 
    document.addEventListener("DOMContentLoaded", function () {
      // Các phần tử trong DOM
      const colorButtons = document.querySelectorAll(".color-btn");
      const sizeOptionsContainer = document.getElementById("size-options");
      const selectedSizeInput = document.getElementById("selected-size");
      const selectedSizeIdInput = document.getElementById("selected-size-id");
      const increaseQtyBtn = document.getElementById("increase-qty");
      const decreaseQtyBtn = document.getElementById("decrease-qty");
      const quantityInput = document.getElementById("quantity");

      // Lấy danh sách kích thước từ thuộc tính data-sizes
      const sizeData = JSON.parse(sizeOptionsContainer.dataset.sizes);

      // Hàm hiển thị các kích thước dựa trên màu sắc đã chọn
      const updateSizes = (color) => {
        // Lọc các kích thước tương ứng với màu
        const filteredSizes = sizeData.filter(size => size.color_name === color);

        // Làm trống container trước khi thêm mới
        sizeOptionsContainer.innerHTML = "";

        // Tạo nút kích thước cho mỗi kích thước phù hợp
        filteredSizes.forEach(size => {
          const sizeButton = document.createElement("button");
          sizeButton.type = "button";
          sizeButton.className = "btn btn-outline-dark size-btn";
          sizeButton.textContent = size.size_name;
          sizeButton.dataset.sizeId = size.product_size_id;

          // Thêm sự kiện khi nhấn nút kích thước
          sizeButton.addEventListener("click", function () {
            // Đặt giá trị vào input hidden
            selectedSizeIdInput.value = size.product_size_id;

            // Đổi trạng thái kích hoạt nút
            document.querySelectorAll(".size-btn").forEach(btn => btn.classList.remove("selected"));
            sizeButton.classList.add("selected");
          });

          // Thêm nút vào container
          sizeOptionsContainer.appendChild(sizeButton);
        });
      };

      // Thêm sự kiện khi nhấn nút màu sắc
      colorButtons.forEach(button => {
        button.addEventListener("click", function () {
          const selectedColor = button.dataset.color;

          // Đổi trạng thái kích hoạt nút màu
          document.querySelectorAll(".color-btn").forEach(btn => btn.classList.remove("selected"));
          button.classList.add("selected");

          // Cập nhật danh sách kích thước tương ứng
          updateSizes(selectedColor);
        });
      });
      increaseQtyBtn.addEventListener("click", function () {
        let currentQty = parseInt(quantityInput.value);
        if (!isNaN(currentQty)) {
          quantityInput.value = currentQty + 1; // Tăng số lượng
        }
      });

      // Sự kiện khi nhấn nút giảm
      decreaseQtyBtn.addEventListener("click", function () {
        let currentQty = parseInt(quantityInput.value);
        if (!isNaN(currentQty) && currentQty > 1) {
          quantityInput.value = currentQty - 1; // Giảm số lượng nhưng không nhỏ hơn 1
        }
      });

      // Đảm bảo giá trị nhập tay luôn hợp lệ
      quantityInput.addEventListener("input", function () {
        let value = parseInt(quantityInput.value);
        if (isNaN(value) || value < 1) {
          quantityInput.value = 1; // Nếu giá trị không hợp lệ, đặt lại về 1
        }
      });
      // Lấy tất cả các ngôi sao
      const stars = document.querySelectorAll('.stars .star');
      const ratingInput = document.querySelector('input[name="rating"]');

      // Hàm đặt màu tất cả các ngôi sao về màu xám
      function resetStarColors() {
        stars.forEach(star => {
          const label = document.querySelector(`label[for=${star.id}] i`);
          if (label) {
            label.classList.remove('fas');
            label.classList.add('far');
          }
        });
      }

      // Hàm xử lý khi một ngôi sao được nhấn
      function handleStarClick(event) {
        // Đặt lại màu xám cho tất cả ngôi sao
        resetStarColors();

        // Lấy id của ngôi sao được nhấn
        const clickedStarId = event.target.id;

        // Phân tích số thứ tự của sao
        const starNumber = parseInt(clickedStarId.replace('star', ''));

        // Đổi màu các ngôi sao từ đầu đến ngôi sao vừa được nhấn thành vàng
        for (let i = 1; i <= starNumber; i++) {
          const label = document.querySelector(`label[for=star${i}] i`);
          if (label) {
            label.classList.remove('far');
            label.classList.add('fas'); // Chuyển thành sao đầy
          }
        }

        // Gán giá trị cho input có name="rating"
        if (ratingInput) {
          ratingInput.value = starNumber;
          console.log(`Current rating: ${ratingInput.value}`); // Debug giá trị
        }
      }

      // Gắn sự kiện click vào các input
      stars.forEach(star => {
        star.addEventListener('click', handleStarClick);
      });

    });


  </script>

  @vite(['resources/client/js/product-detail.js', 'resources/client/css/product-detail.css', 'resources/client/css/product-review.css'])
  @endsection