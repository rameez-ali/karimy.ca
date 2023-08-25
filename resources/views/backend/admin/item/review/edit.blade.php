@extends('backend.admin.layouts.app')

@section('styles')
    <!-- Bootstrap FD Css-->
    <link href="{{ asset('backend/vendor/bootstrap-fd/bootstrap.fd.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">{{ __('review.backend.edit-a-review') }}</h1>
            <p class="mb-4">{{ __('review.backend.write-a-review-desc') }}</p>
        </div>
        <div class="col-3 text-right">
            <a href="{{ route('user.items.reviews.index') }}" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-backspace"></i>
                </span>
                <span class="text">{{ __('backend.shared.back') }}</span>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">

            <div class="row">
                <div class="col-3">
                    @if(empty($item->item_image))
                        <img id="image_preview" src="{{ asset('backend/images/placeholder/full_item_feature_image.webp') }}" class="img-responsive rounded">
                    @else
                        <img id="image_preview" src="{{ url('storage/item/'. $item->item_image) }}" class="img-responsive rounded">
                    @endif

                    <a target="_blank" href="{{ route('page.item', $item->item_slug) }}" class="btn btn-primary btn-block mt-2">{{ __('backend.message.view-listing') }}</a>

                </div>
                <div class="col-9">
                    <p>
                        @foreach($item->allCategories()->get() as $key => $category)
                            <span class="bg-info rounded text-white pl-2 pr-2 pt-1 pb-1 mr-1">
                                {{ $category->category_name }}
                            </span>
                        @endforeach
                    </p>
                    <h1 class="h4 mb-2 text-gray-800">{{ $item->item_title }}</h1>
                    <p class="mb-4">
                        @if($item->item_type == \App\Item::ITEM_TYPE_REGULAR)
                        {{ $item->item_address_hide == \App\Item::ITEM_ADDR_NOT_HIDE ? $item->item_address . ', ' : '' }} {{ $item->city->city_name . ', ' . $item->state->state_name . ' ' . $item->item_postal_code }}
                        @else
                            <span class="bg-primary text-white pl-1 pr-1 rounded">{{ __('theme_directory_hub.online-listing.online-listing') }}</span>
                        @endif
                    </p>
                    <hr/>
                    <p class="mb-4">{{ $item->item_description }}</p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-8">
                  <form method="POST" action="{{ route('admin.items.reviews.update', ['item_slug' => $item->item_slug, 'review' => $review->id]) }}">
                  @csrf
                  @method('PUT')
                  <div class="flex column">
                          <label for="star1">
                            <div class="flex">
                              <div>
                                @if($review->rating == "1")
                                <input hidden type="radio" id="star1" value="1" class="star" name="rating"checked />
                                @else
                                <input hidden type="radio" id="star1" value="1" class="star" name="rating"/>
                                @endif
                                <span class="fa fa-star"></span>
                              </div>
                              <div>Poor</div>
                            </div>
                          </label>
                          <label for="star2">
                            <div class="flex">
                              <div>
                                @if($review->rating == "2")
                                <input hidden type="radio" id="star2" value="2" class="star" name="rating"checked />
                                @else
                                <input hidden type="radio" id="star2" value="2" class="star" name="rating"/>
                                @endif
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                              </div>
                              <div>Fair</div>
                            </div>
                          </label>
                          <label for="star3">
                            <div class="flex">
                              <div>
                                @if($review->rating == "3")
                                <input hidden type="radio" id="star3" value="3" class="star" name="rating"checked />
                                @else
                                <input hidden type="radio" id="star3" value="3" class="star" name="rating"/>
                                @endif
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                              </div>
                              <div>Good</div>
                            </div>
                          </label>
                          <label for="star4">
                            <div class="flex">
                              <div>
                                @if($review->rating == "4")
                                <input hidden type="radio" id="star4" value="4" class="star" name="rating"checked />
                                @else
                                <input hidden type="radio" id="star4" value="4" class="star" name="rating"/>
                                @endif
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                              </div>
                              <div>Very Good</div>
                            </div>
                          </label>
                          <label class="star5">
                            <div class="flex">
                              <div>
                                @if($review->rating == "5")
                                <input hidden type="radio" id="star5" value="5" class="star" name="rating"checked />
                                @else
                                <input hidden type="radio" id="star5" value="5" class="star" name="rating"/>
                                @endif
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                              </div>
                              <div>Exceptional</div>
                            </div>
                          </label>
                        </div>

                        <div class="form-row mb-3">
                            <div class="col-md-12">
                                <label for="body" class="text-black">{{ __('review.backend.description') }}</label>
                                <textarea class="form-control @error('body') is-invalid @enderror" id="body" rows="5" name="body">{{ $review->body }}</textarea>
                                @error('body')
                                <span class="invalid-tooltip">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row mb-3">
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input {{ (old('recommend') ? old('recommend') : ($review->recommend == \App\Item::ITEM_REVIEW_RECOMMEND_YES ? 1 : 0)) == 1 ? 'checked' : '' }} class="form-check-input" type="checkbox" id="recommend" name="recommend" value="1">
                                    <label class="form-check-label" for="recommend">
                                        {{ __('review.backend.recommend') }}
                                    </label>
                                </div>
                                @error('recommend')
                                <span class="invalid-tooltip">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row mb-3">
                            <div class="col-md-12">
                                <span class="text-lg text-gray-800">{{ __('review_galleries.upload-photos') }}</span>
                                <small class="form-text text-muted">
                                    {{ __('review_galleries.upload-photos-help') }}
                                </small>
                                @error('review_image_galleries')
                                <span class="invalid-tooltip">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button id="upload_gallery" type="button" class="btn btn-primary mb-2">{{ __('review_galleries.choose-photo') }}</button>
                                        <div class="row" id="selected-images">
                                            @foreach($review_image_galleries as $key => $review_gallery)
                                                <div class="col-lg-3 col-md-4 col-sm-6 mb-2" id="review_image_gallery_{{ $review_gallery->id }}">
                                                    <img class="review_image_gallery_img" src="{{ url('storage/item/review/'. $review_gallery->review_image_gallery_thumb_name) }}">
                                                    <br/><button class="btn btn-danger btn-sm text-white mt-1" onclick="$(this).attr('disabled', true); deleteGallery({{ $review_gallery->id }});">{{ __('backend.shared.delete') }}</button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row mb-3">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-success py-2 px-4 text-white">
                                    {{ __('review.backend.update-review') }}
                                </button>
                            </div>
                            <div class="col-md-4 text-right">
                                <a class="text-danger" href="#" data-toggle="modal" data-target="#deleteModal">
                                    {{ __('backend.shared.delete') }}
                                </a>
                            </div>
                        </div>
                        </form>
                    </div>
                <div class="col-4"></div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('backend.shared.delete-confirm') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('review.backend.delete-a-review') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('backend.shared.cancel') }}</button>
                    <form action="{{ route('user.items.reviews.destroy', ['item_slug' => $item->item_slug, 'review' => $review->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('backend.shared.delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <!-- Bootstrap Fd Plugin Js-->
    <script src="{{ asset('backend/vendor/bootstrap-fd/bootstrap.fd.js') }}"></script>

    <script>
        function deleteGallery(domId)
        {
            //$("form :submit").attr("disabled", true);

            var ajax_url = '/ajax/item/review/gallery/delete/' + domId;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: ajax_url,
                method: 'post',
                data: {
                },
                success: function(result){
                    console.log(result);
                    $('#review_image_gallery_' + domId).remove();
                }});

        }

        $(document).ready(function() {

            "use strict";

            /**
             * Start image gallery uplaod
             */
            $('#upload_gallery').on('click', function(){
                window.selectedImages = [];

                $.FileDialog({
                    accept: "image/jpeg",
                }).on("files.bs.filedialog", function (event) {
                    var html = "";
                    for (var a = 0; a < event.files.length; a++) {

                        if(a == 12) {break;}
                        selectedImages.push(event.files[a]);
                        html += "<div class='col-lg-3 col-md-4 col-sm-6 mb-2' id='review_image_gallery_" + a + "'>" +
                            "<img style='max-width: 120px;' src='" + event.files[a].content + "'>" +
                            "<br/><button class='btn btn-danger btn-sm text-white mt-1' onclick='$(\"#review_image_gallery_" + a + "\").remove();'>" + "{{ __('backend.shared.delete') }}" + "</button>" +
                            "<input type='hidden' value='" + event.files[a].content + "' name='review_image_galleries[]'>" +
                            "</div>";
                    }
                    document.getElementById("selected-images").innerHTML += html;
                });
            });
            /**
             * End image gallery uplaod
             */

        });
    </script>

@endsection
