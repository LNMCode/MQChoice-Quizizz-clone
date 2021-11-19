class Play {
  final String _id;
  final String idques;
  final String idans;
  final bool istrue;

  const Play(this._id, this.idques, this.idans, this.istrue);

  Play.fromJson(Map<String, dynamic> json)
      : _id = json['_id'] ?? "",
        idques = json['idques'],
        idans = json['idans'],
        istrue = json['istrue'];
}
