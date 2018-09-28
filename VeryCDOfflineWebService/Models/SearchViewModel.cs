using System;
using System.Linq;

namespace VeryCDOfflineWebService.Models
{
	public class SearchViewModel
	{
		public SearchViewModel(IQueryable<Entry> entries, Int32 page, Int32 itemsPerPage)
		{
			this.Entries = entries;
			this.ItemsPerPage = itemsPerPage;

			this.CurrentPage = page;
			this.TotalPages = (Int32)Math.Ceiling((Decimal)entries.Count() / ItemsPerPage);

			this.PagedEntries = this.Entries.Skip((page - 1) * itemsPerPage).Take(itemsPerPage);
		}

		public IQueryable<Entry> Entries { get; }
		public IQueryable<Entry> PagedEntries { get; }

		public Int32 CurrentPage { get; set; }
		public Int32 TotalPages { get; }
		public Int32 ItemsPerPage { get; set; }

		public Boolean HasPreviousPage => (this.CurrentPage > 1);
		public Boolean HasNextPage => (this.CurrentPage < this.TotalPages);
	}
}