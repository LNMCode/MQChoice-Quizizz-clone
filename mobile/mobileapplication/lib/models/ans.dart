class Ans {
  final String _id;
  final String idans;
  final String valueans;
  final String color;
  final String color_v2;

  const Ans(this._id, this.idans, this.valueans, this.color, this.color_v2);

  Ans.fromJson(Map<String, dynamic> json)
      : _id = json['_id'] ?? "",
        idans = json['idans'],
        valueans = json['valueans'],
        color = json['color'],
        color_v2 = json['color_v2'];
}
