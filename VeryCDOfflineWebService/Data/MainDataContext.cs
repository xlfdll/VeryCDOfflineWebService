using Microsoft.EntityFrameworkCore;

using VeryCDOfflineWebService.Models;

namespace VeryCDOfflineWebService.Data
{
	public class MainDataContext : DbContext
	{
		public MainDataContext(DbContextOptions<MainDataContext> options)
			: base(options) { }

		public DbSet<Entry> Entries { get; set; }
	}
}