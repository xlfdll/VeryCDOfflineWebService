using System;

namespace VeryCDOfflineWebService.Models
{
	public class Entry
	{
		public Int32 ID { get; set; }
		public String Title { get; set; }
		public String Description { get; set; }
		public String Link { get; set; }
		public String Category { get; set; }
		public String SubCategory { get; set; }
		public DateTime PublishTime { get; set; }
		public DateTime UpdateTime { get; set; }
	}
}