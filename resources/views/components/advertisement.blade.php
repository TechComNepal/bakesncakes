  @props([
    'col' => '12',
])
  <div class="review-area">
      <div class="container">
          <div class="row">
              @foreach ($getAdvertisement->where('status', '1') as $advertisement)
                  <div class="col-lg-{{ $advertisement->columns ?? $col }} mb-4">
                      @if ($advertisement->columns == 12)
                          <div class="review-img">
                              <a
                              @if($advertisement->link))
                              href="{{ $advertisement->link }}"
                              @endif
                              target="__blank">
                                  <img alt="{{ $advertisement->name ?? 'Bakes and Cakes' }}" class="ps-promo__banner"
                                      src="{{ $advertisement->getFirstOrDefaultMediaUrl('image', 'banner') }}" />
                              </a>
                          </div>
                      @else
                          <div class="review-img">
                              <a href="javascript:void(0)">
                                  <img alt="{{ $advertisement->name ?? 'Bakes and Cakes' }}" class="ps-promo__banner"
                                      src="{{ $advertisement->getFirstOrDefaultMediaUrl('image', 'card') }}" />
                              </a>
                          </div>
                      @endif
                      <div class="chef-item">
                          <div class="chef-top">
                              <div class="chef-inner">
                                  <h3>{{ $advertisement->brand->name }}</h3>
                                  <span>{{ $advertisement->name ?? 'Bakes and Cakes' }}</span>
                              </div>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
  </div>
