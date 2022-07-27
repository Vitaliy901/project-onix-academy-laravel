$('.slider').slick({
	infinite: true,
	cssEase: 'ease-out',
	speed: 1000,
	arrows: false,
	pauseOnHover: true,
	centerMode: true,
	centerPadding: '0px',
	centerMode: true,
	slidesToShow: 3,
	responsive: [
	{
		breakpoint: 1200,
			settings: {
			slidesToShow: 2,
			autoplay: true,
			autoplaySpeed: 2500,
			}
		},
		{
			breakpoint: 768,
			settings: {
			centerMode: false,
			slidesToShow: 1,
			autoplay: true,
			autoplaySpeed: 2500,
			}
		}]
});

/* $('.single-item').slick({
	centerMode: true,
	slidesToShow: 1,
	slidesToScroll: 1,
	dots: false,
	arrows: false,
	infinite: true,
	cssEase: 'linear',
	variableWidth: true,
	variableHeight: true,
	mobileFirst: false,
	responsive: [{
	  breakpoint: 1300,
	  settings: {
		slidesToShow: 3,
		slidesToScroll: 1,
		centerMode: false
	  }
	}]
  }); */