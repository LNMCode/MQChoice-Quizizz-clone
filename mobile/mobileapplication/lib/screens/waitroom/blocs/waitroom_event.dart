import 'package:equatable/equatable.dart';
import 'package:mobileapplication/responsitory/stream_socket.dart';

abstract class WaitRoomEvent extends Equatable {
  const WaitRoomEvent();

  @override
  List<Object?> get props => [];
}

class WaitRoomEventConnected extends WaitRoomEvent {
  final String idroom;
  final String iduser;
  final String nameuser;

  const WaitRoomEventConnected({
    required this.idroom,
    required this.iduser,
    required this.nameuser,
  });

  @override
  List<Object?> get props => [idroom, iduser, nameuser];
}
