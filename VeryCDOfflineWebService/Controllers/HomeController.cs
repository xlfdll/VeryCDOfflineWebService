using System;
using System.Linq;

using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.Options;

using VeryCDOfflineWebService.Data;
using VeryCDOfflineWebService.Models;

namespace VeryCDOfflineWebService.Controllers
{
	public class HomeController : Controller
	{
		public HomeController(MainDataContext dataContext, IOptions<AppSettings> optionsAccessor)
		{
			this.DataContext = dataContext;
			this.Settings = optionsAccessor.Value;
		}

		public MainDataContext DataContext { get; }
		public AppSettings Settings { get; }

		[HttpGet]
		public IActionResult Index()
		{
			return View();
		}

		[HttpGet]
		public IActionResult Search(String keyword, Int32 page)
		{
			if (!String.IsNullOrEmpty(keyword))
			{
				if (page < 1)
				{
					page = 1;
				}

				IQueryable<Entry> results = from entry in this.DataContext.Entries
											where EF.Functions.Like(entry.Title, $"%{keyword}%")
											select entry;

				ViewBag.Keyword = keyword;

				return View(new SearchViewModel(results, page, this.Settings.ItemsPerPage));
			}
			else
			{
				return RedirectToAction("Index");
			}
		}

		[HttpGet]
		public IActionResult Show(Int32 id)
		{
			return View(this.DataContext.Entries.Where(entry => entry.ID == id).Single());
		}
	}
}