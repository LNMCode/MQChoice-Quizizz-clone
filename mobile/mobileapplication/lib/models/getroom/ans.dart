class Ans {
  final String _id;
  final String idans;
  final String valueans;
  final String color;
  final String colorv2;

  const Ans(this._id, this.idans, this.valueans, this.color, this.colorv2);

  Ans.fromJson(Map<String, dynamic> json)
      : _id = json['_id'] ?? "",
        idans = json['idans'],
        valueans = json['valueans'],
        color = json['color'],
        colorv2 = json['colorv2'];
}
