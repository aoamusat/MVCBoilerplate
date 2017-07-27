<?php
	

	class PagesController
	{

		/**
		 * Go to the homepage
		 * @return view
		 */
		public function home()
		{
			return Helper::view('index');
		}

		/**
		 * [about description]
		 * @return [type] [description]
		 */
		public function about()
		{
			return Helper::view('about');
		}

		/**
		 * [contact description]
		 * @return [type] [description]
		 */
		public function contact()
		{
			return Helper::view('contact');
		}
	}